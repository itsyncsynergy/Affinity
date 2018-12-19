<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use JWTAuth;
use JWTFactory;
use OneSignal;
use JWTAuthException;
use App\User;
use App\Customer;
use App\CustomerGroup;
use App\AppNotifications;
use App\CustomerEvent;
use App\CustomerExperience;
use App\CustomerLuxuryExperience;
use App\Subscription;
use Mail;
use App\Event;
use App\Experience;

class ApiController extends Controller
{

    public function __construct()
    {
        $this->user = new User;
    }
    
    public function login(Request $request)
    {
    
        $credentials = $request->only('username', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_username_or_password',
                    'code' => 1,
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
                'code' => 2,
            ]);
        }
        $user = User::where([
            ['username', '=', $request->username],
            ['status', '=', 0],
        ])->first();

        $login = User::where('username', $request->username)->first();

        if ($user) {

            return response()->json([
                'response' => 'error',
                'message' => 'Account is not Verified',
                'code' => 3,
                
            ]);

        }
        elseif($login){

            $login->user_token = $token;
            if($login->save()){
                
                $user = DB::table('customers')->join('users','users.details_id','=','customers.customer_id')
                ->where('username', $request->username)
                ->select('customers.*', 'users.*')->get()->first();

                $userInterest = DB::table('customer_group')
                ->join('users', 'users.details_id','=','customer_group.customer_id')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name')
                ->where('username', $request->username)
                ->get();

                $activities = DB::table('events')
                ->join('customer_event', 'events.event_id', '=', 'customer_event.event_id')
                ->select('events.name', 'events.location')
                ->where('customer_event.customer_id', $user->details_id)
                ->get();

                $redemption = DB::table('merchant_offers')
                ->join('transactions', 'merchant_offers.merchant_id', '=', 'transactions.merchant_id')
                ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
                ->select('merchant_offers.*', 'merchants.name')
                ->where('transactions.customer_id', $user->details_id)
                ->get();

                $today = Carbon::now();
        
                $sub = Subscription::where('customer_id', $user->details_id)->first();
                if ($sub) {
                        if ($today <= $sub->end_date ) {

                        $date = date_create($sub->end_date);

                        $new = date_format($date, "F d, Y");

                        $message = 'Your Subscription will Expire on'.' '. $new;

                        $sub['expiry_message'] = $message;

                        if ($userInterest->isEmpty()) {

                            $userInterest = null;

                        }
                        if ($activities->isEmpty()) {

                           $activities = null;

                        }
                        if ($redemption->isEmpty()) {

                            $redemption = null;
                            
                        }
                        return response()->json([
                            'response' => 'success',
                            'token' => $token,
                            'user'=> $user,
                            'interest' => $userInterest,
                            'activities' => $activities,
                            'redemption' => $redemption,
                            'subscription' => $sub,
                            
                            
                        ]);

                        } 
                        else {

                            $date = date_create($sub->end_date);

                            $new = date_format($date, "F d, Y");

                            $message = 'Your Subscription expired on '.' '. $new;

                            $sub['message'] = $message;

                            return response()->json([
                            'response' => 'success',
                            'token' => $token,
                            'user'=> $user,
                            'interest' => $userInterest,
                            'activities' => $activities,
                            'redemption' => $redemption,
                            'subscription' => $sub,
                            
                            
                            ]);

                        }

                } else {

                            $message = 'No Subscription';

                            $sub['message'] = $message;

                            return response()->json([
                            'response' => 'success',
                            'token' => $token,
                            'user'=> $user,
                            'interest' => $userInterest,
                            'activities' => $activities,
                            'redemption' => $redemption,
                            'subscription' => $sub,
                            
                            ]);

                }


            }
        }
        
    
    }

    public function signup(Request $request)
    {   
        $pin = mt_rand(1000,9999);

        if (!$request->input('name') || !$request->input('email') || !$request->input('phone') || !$request->input('code') || !$request->input('password')) {
           return response()->json([ 
                'response' => 'error',
                'message' => 'All required parameters not supplied'
            ], 200);
        }

        $notVerifiedUser = User::where([
            ['username', '=', $request->input('email')],
            ['status', '=', 0],
        ])->first();

        $existUser = User::where([
            ['username', '=', $request->input('email')],
            ['status', '=', 1],
        ])->first();

        // $existPhone = Customer::where([
        //     ['email', '=', $request->input('email')],
        //     ['phone', '=', $request->input('phone')],
        // ])->first();

        $existPhone = Customer::where('phone', '=', $request->input('phone') )->first();

        if ($existPhone) {
            return response()->json([ 
                'response' => 'error',
                'message' => 'Phone Number Already Taken',
                'code' => 4
            ], 200);
        }

        if ($notVerifiedUser) {

            $exist = Customer::where([
            ['email', '=', $request->input('email')],
            ['phone', '=', $request->input('phone')],
            ])->first();

            if ($exist) {
                $data = [
                    'email'=> $request->input('email'),
                    'verify_code'=> $pin,
                    'date' =>date('Y-m-d')
                    ];
             
                    Mail::send('emails.verify', $data, function($message) use($data){
                        
                        $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                        $message->SMTPDebug = 4; 
                        $message->to($data['email']);
                        $message->subject('Verification Code');
                        
                    });
            $user = User::where('username', $request->input('email'))->first();

            $user->verification_code = $pin;

                if ($user->save()) {
                    return response()->json([ 
                    'response' => 'error',
                    'message' => 'Your Account is not Verified, Verification Code Sent to your Email Address',
                    'code' => 3,
                ], 200);

                }
            } 
             
        }elseif ($existUser) {

           return response()->json([ 
                'response' => 'error',
                'message' => 'Email Already Taken'
            ], 200);
        }
        else{

            $customer = new Customer;
            
            $name = $request->input('name');
            $parts = explode(' ', $name);

            if (sizeof($parts) == 1) {
                return response()->json([
                    'response' => 'error', 
                    'message' => 'Please provide full name'
                ], 300); 
            }

            $firstname = $parts[0];

            $lastname = $parts[1];
            
            $customer->customer_id = substr(strtoupper($request->input('name')), 0,3).'-'.time();

            $customer->firstname = $firstname;

            $customer->lastname = $lastname;

            $customer->phone = $request->input('phone');

            $customer->country_code = $request->input('code');

            $customer->email = $request->input('email');

            $customer->status = 'Inactive';

            $customer->avatar = 'images/profile.png';
 
        
        if($customer->save()){
            
            $user = new User;
            $user->username = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->group_id = 1;
            $user->status = 0;
            $user->details_id = $customer->customer_id;
            $user->user_type = 'customer';
            $user->verification_code = $pin;



            if($user->save()){

                $data = [
                    'email'=> $request->input('email'),
                    'verify_code'=> $pin,
                    'date' =>date('Y-m-d')
                    ];
             
                    Mail::send('emails.verify', $data, function($message) use($data){
                        
                        $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                        $message->SMTPDebug = 4; 
                        $message->to($data['email']);
                        $message->subject('Verification Code');
                        
                    });

                return response()->json([
                    'success' => true, 
                    'message' => 'Account created successfully. Check your Email for your verification code'
                ], 200);
            }
            else{
                return response()->json([
                    'error' => true, 
                    'message' => 'An error occured. Please try again'
                ], 500);
            }
        }   
        else{
                return response()->json([
                    'error' => true, 
                    'message' => 'An error occured. Please try again'
                ], 500);
            } 

        }
        
    }

    public function getAuthUser(Request $request)
    {
        
        try{
            $user = JWTAuth::authenticate($request->token);

            return response()->json(['user' => $user]);

        } catch (JWTException $exception){
            return response()->json([
                'success' => false,
                'message' => 'User is not logged in!!!'
            ], 401);
        }
         
    }

    public function logout(Request $request)
    {
 
        try {
            JWTAuth::invalidate($request->token);
 
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function resetMail(Request $request)
    {
        $email = $request->input('email');

        $pin = Str::random(10);

        $user = User::where('username', $email)->first();

        if ($user) {
            $user->reset_pass = $pin;

            $user->password = bcrypt($pin);

            if ($user->save()) {
                $sender = 'adedotun.kasim@itsync.ng';
    
                $data = [
                'email'=> $email,
                'pin'=> $pin,
                'date' =>date('Y-m-d')
                ];
     
                Mail::send('emails.mail', $data, function($message) use($data){
                    
                    $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                    $message->SMTPDebug = 4; 
                    $message->to($data['email']);
                    $message->subject('Password Recovery');
                    
                });
    
                return response()->json([
                    'success' => true,
                    'message' => 'Check your Email for your new password'
                ]);
    
            }
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email Address'
            ]);
        }

        
 
        
        
        
    }

    public function checkCode(Request $request)
    {   

        $code = $request->input('code');

        $email = $request->input('email');

        if (!$code || !$email) {
           return response()->json([ 
                'error' => true,
                'message' => 'All required parameters not supplied'
            ], 200);
        }

        $user = DB::table('users')
        ->where([
            ['verification_code', '=', $code],
            ['username', '=', $email],
        ])
        ->get()
        ->first();


        if ($user) {

            $user = User::where('username', $email)->first();

            $token = JWTAuth::fromUser($user);

            $user->status = 1;

            $user->user_token = $token;
            

            $user->save();

            $customer = Customer::where('email', $email)->first();

            $customer->status = 'Active';

            if ($customer->save()) {
                $user = DB::table('customers')->join('users','users.details_id','=','customers.customer_id')
                ->where('username', $email)
                ->select('customers.*', 'users.*')->get()->first();

                $userInterest = DB::table('customer_group')
                ->join('users', 'users.details_id','=','customer_group.customer_id')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name')
                ->where('username', $request->username)
                ->get();



                $activities = DB::table('events')
                ->join('customer_event', 'events.event_id', '=', 'customer_event.event_id')
                ->select('events.name', 'events.location')
                ->where('customer_event.customer_id', $user->details_id)
                ->get();

                $redemption = DB::table('merchant_offers')
                ->join('transactions', 'merchant_offers.merchant_id', '=', 'transactions.merchant_id')
                ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
                ->select('merchant_offers.*', 'merchants.name')
                ->where('transactions.customer_id', $user->details_id)
                ->get();

                $today = Carbon::now();
        
                $sub = Subscription::where('customer_id', $user->details_id)->first();

                if ($sub) {
                        if ($today <= $sub->end_date ) {

                        $date = date_create($sub->end_date);

                        $new = date_format($date, "F d, Y");

                        if ($userInterest->isEmpty()) {

                            $userInterest = null;

                        }
                        if ($activities->isEmpty()) {

                           $activities = null;

                        }
                        if ($redemption->isEmpty()) {

                            $redemption = null;
                            
                        }

                        return response()->json([
                            'error' => false,
                            'message' => 'Verification Successful and your account is active',
                            'token' => $token,
                            'user'=> $user,
                            'interest' => $userInterest,
                            'activities' => $activities,
                            'redemption' => $redemption,
                            'subscription' => $sub,
                            'expiry_message' => 'Your Subscription will Expire on'.' '. $new,
                            
                        ]);

                        } 
                        else {

                            $date = date_create($sub->end_date);

                            $new = date_format($date, "F d, Y");

                            return response()->json([
                            'error' => false,
                            'message' => 'Verification Successful and your account is active',
                            'token' => $token,
                            'user'=> $user,
                            'interest' => $userInterest,
                            'activities' => $activities,
                            'redemption' => $redemption,
                            'subscription' => $sub,
                            'expiry_message' => 'Your Subscription expired on '.' '. $new,
                            
                            ]);

                        }

                } else {

                            return response()->json([
                            'error' => false,
                            'message' => 'Verification Successful and your account is active',
                            'token' => $token,
                            'user'=> $user,
                            'interest' => $userInterest,
                            'activities' => $activities,
                            'redemption' => $redemption,
                            'subscription' => $sub,
                            'expiry_message' => 'No Subscription',
                            
                            ]);

                }
                
              } 
            
            }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Verification Code or Email doesnt Match'
            ]);
        }
    }

    public function editprofile(Request $request)
    {

        $first = $request->input('firstname');

        $last = $request->input('lastname');

        $email = $request->input('username');

        $pass = $request->input('newpass');

        $confirmpass = $request->input('confirmpass');

         
        
        $user = User::where('username', $email)->first();

        if (!$user) {

            return response()->json([
                'error' => true, 
                'message' => 'Email Doesnt Exist'
            ]);

        }

        if ($pass != $confirmpass) {
            
            return response()->json([
                'error' => true,
                'code' => 502, 
                'message' => 'Password Doesnt Match'
            ]);

        }else{
            $user->password = bcrypt($pass);

        if ($user->save()) {

            $customer = Customer::where('email', $email)->first();

            $customer->firstname = $first;

            $customer->lastname = $last;

            if ($customer->save()) {

                return response()->json([
                'error' => false,
                'code' => 200,
                'user' => $customer,
                'message' => 'Your Profile has been updated successfully'
            ]);

            }
            
        }
        else{

            return response()->json([
                'error' => true,
                'code' => 500, 
                'message' => 'Password Cannot be changed'
            ]);
        }

        }

        
    }

    public function changepassword(Request $request)
    {
        $pin = $request->input('pin');

        $pass = $request->input('password');

        $email = $request->input('email');

        $user = User::where([
            ['reset_pass', '=', $pin],
            ['username', '=', $email],
        ])
        ->get()
        ->first();

        if ($user) {

            $user->password = bcrypt($pass);

            $user->save();

            return response()->json([
                'error' => false, 
                'message' => 'Your Password has been changed successfully'
            ]);
           
        }
        else{

            return response()->json([
                'error' => true, 
                'message' => 'Password Couldnt be changed'
            ]);

        }

    }

    public function membership(Request $request)
    {
        $mem_type = $request->input('mem_type');

        $email = $request->input('email');

        $group_id = $request->input('group_id');

        $customer_id = $request->input('customer_id');

        $created_at = Carbon::now();

        $updated_at = Carbon::now();

        // $created_at = date('Y-m-d H:i:s');

        $customer = Customer::where('email', $email)->first();

        if ($mem_type == 'Essence') {

                $customer->membership_id = 1;

                $customer->membership = $$mem_type;

            }elseif ($mem_type == 'Premium') {

                $customer->membership_id = 2;

                $customer->membership = $mem_type;

            }elseif ($mem_type == 'Luxe') {

                $customer->membership_id = 3;

                $customer->membership = $mem_type;

            }else{
                $customer->membership_id = 0;

                $customer->membership = '';
            }

        if ($customer->save()) {

            $user = DB::table('customer_group')->insert(['customer_id' => $customer_id, 'group_id' => $group_id, 'created_at' => $created_at, 'updated_at' => $updated_at]);

            if ($user) {

                return response()->json([
                'error' => false, 
                'message' => 'Membership saved'
                ]);

            }

        }
        else{
                return response()->json([
                'error' => true, 
                'message' => 'Error occurred...'
                ]);

        }

    }

    public function saveInterest(Request $request)
    {
        $group_id = $request->input('group_id');

        $customer_id = $request->input('customer_id');

        $status = $request->input('status');

        if ($status == 1) {

            $groupCustomer = CustomerGroup::where([
                    ['customer_id', '=', $customer_id],
                    ['group_id', '=', $group_id],
            ])->first();

            if ($groupCustomer) {

                $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

                return response()->json([

                    'interest' => $userInterest

                ]);
                
            } 
            else {
                
                    $customer_group = new CustomerGroup;

                    $customer_group->customer_id = $customer_id;

                    $customer_group->group_id = $group_id;

                    $customer_group->status = $status;

                    if ($customer_group->save()) {
                        
                        $userInterest = DB::table('customer_group')
                        ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                        ->select('customer_group.group_id', 'groups.name')
                        ->where('customer_group.customer_id', $customer_id)
                        ->get();

                        if ($userInterest->isEmpty()) {
                            
                            $userInterest = null;
                        } 

                        return response()->json([
                            'interest' => $userInterest
                        ]);
                    } 
            }
            
            
        } elseif ($status == 0) {

            $customer = DB::table('customer_group')
            ->where([
                ['customer_id', '=', $customer_id],
                ['group_id', '=', $group_id],
            ]);

            $delete = $customer->first();

            if ($customer->delete()) {
                
                $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

                if ($userInterest->isEmpty()) {
                    
                    $userInterest = null;
                } 
                

                return response()->json([

                    'interest' => $userInterest
                ]);
            } 
            
        } 

   
    }

    public function changepic(Request $request, $customer_id)
    {

        if($request->hasFile('file')){

            $avatar = $request->file('file'); 
    
            $extension = $avatar->extension();
    
            $filename = time();
    
            $path = 'images/'.$filename.'.'.$extension;
    
            move_uploaded_file($avatar, public_path($path));

            $customer = Customer::where('customer_id', $customer_id)->first();

            $customer->avatar = $path;

            if ($customer->save()) {

                return response()->json([
                'error' => false,
                'code' => 200,
                'message' => 'image successfully saved to '. $path,
                'avatar' => $path

                ]);
            } 
      
        }
        else {

            return response()->json([
                'error' => true,
                'code' => 201,
                'message' => 'No image selected'
            ]);
        }
        
    }

   public function InterestedIn($id)
   {
       
   }

   public function playTest(Request $request)
   {
       
       // $service = $request->input('service');

       // $dot = implode(', ', array_map(function($entry) {
       //      return $entry['name'];
       //  }, $service));


       // $parts = explode(' ', $service);

       // $start_date = $parts[0];

       // $end_date = $parts[1];

        $userid = $request->input('user_id');

        OneSignal::sendNotificationToUser("Some Message", $userid, $url = null, $data = null);

        return response()->json([
            'error' => false,
            'message' => 'Notification sent'
            ]);
   }

    public function pickInterest($customer_id, $group_id, $status)
    {

        if ($status == 1) {

            $groupCustomer = CustomerGroup::where([
                    ['customer_id', '=', $customer_id],
                    ['group_id', '=', $group_id],
            ])->first();

            if ($groupCustomer) {

                $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

                $size = sizeof($userInterest);

                return response()->json([
                    'error' => false,
                    'interest' => $userInterest,
                    'userSelect' => $size

                ]);
                
            } 
            else {
                
                    $customer_group = new CustomerGroup;

                    $customer_group->customer_id = $customer_id;

                    $customer_group->group_id = $group_id;

                    $customer_group->status = $status;

                    if ($customer_group->save()) {
                        
                        $userInterest = DB::table('customer_group')
                        ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                        ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                        ->where('customer_group.customer_id', $customer_id)
                        ->get();

                        $size = sizeof($userInterest);

                        if ($userInterest->isEmpty()) {
                            
                            $userInterest = null;

                            $size = 0;
                        } 

                        return response()->json([
                            'error' => false,
                            'interest' => $userInterest,
                            'userSelect' => $size
                        ]);
                    } 
            }
            
            
        } elseif ($status == 0) {

            $customer = DB::table('customer_group')
            ->where([
                ['customer_id', '=', $customer_id],
                ['group_id', '=', $group_id],
            ]);

            $delete = $customer->first();

            if ($customer->delete()) {
                
                $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

                $size = sizeof($userInterest);

                if ($userInterest->isEmpty()) {
                    
                    $userInterest = null;
                    
                    $size = 0;
                } 
                

                return response()->json([
                    'error' => false,
                    'interest' => $userInterest,
                    'userSelect' => $size
                ]);
            } 
            
        } 

   
    }

    public function saveEvent(Request $request)
    {
        $customer_event = new CustomerEvent;

        $customer_event->customer_id = $request->input('customer_id');

        $customer_event->event_id = $request->input('event_id');

        $get_event_name = Event::where('event_id', $request->input('event_id'))->first();

        $name = $get_event_name->name;

        if ($customer_event->save()) {

            $notification = new AppNotifications;

                $notification->customer_id = $request->input('customer_id');

                $notification->message = 'Congratulations! There’s a seat at the '. $name.' with your name on it. Kindly check your email for more information.';

                $notification->status = 1;

                $notification->save();

            $activities = DB::table('events')
                ->join('customer_event', 'events.event_id', '=', 'customer_event.event_id')
                ->select('events.name', 'events.location')
                ->where('customer_event.customer_id', $request->input('customer_id'))
                ->get();
           
            return response()->json([
                'error' => false,
                'message' => 'success',
                'activities' => $activities
            ]);
            
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Error Occurred'
            ]);
        }
        
    }

    public function saveExperience(Request $request)
    {
        $customer_exp = new CustomerExperience;

        $customer_exp->customer_id = $request->input('customer_id');

        $customer_exp->experience_id = $request->input('experience_id');

        $customer_exp->status = 'Pending';

        $get_experience_name = Experience::where('experience_id', $request->input('experience_id'))->first();

        $name = $get_experience_name->experience_name;

        if ($customer_exp->save()) {

            $notification = new AppNotifications;

            $notification->customer_id = $request->input('customer_id');

            $notification->message = 'Confirmed! You are attending the  '. $name.'. Please, see your email for more information.';

            $notification->status = 1;

            $notification->save();
           
            return response()->json([
                'error' => false,
                'message' => 'success'
            ]);
            
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Error Occurred'
            ]);
        }
    }

    public function saveLuxury(Request $request)
    {
        $customer_exp = new CustomerLuxuryExperience;

        $customer_exp->customer_id = $request->input('customer_id');

        $customer_exp->experience_id = $request->input('experience_id');

        $customer_exp->status = 'Pending';        

        if ($customer_exp->save()) {
           
            return response()->json([
                'error' => false,
                'message' => 'success'
            ]);
            
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Error Occurred'
            ]);
        }
    }

    public function ResendCode($email)
    {
        $pin = mt_rand(1000,9999);

        $user = User::where('username', $email)->first();

        $user->verification_code = $pin;

                if ($user->save()) {
                    $data = [
                        'email'=> $email,
                        'verify_code'=> $pin,
                        'date' =>date('Y-m-d')
                        ];
                 
                        Mail::send('emails.verify', $data, function($message) use($data){
                            
                            $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                            $message->SMTPDebug = 4; 
                            $message->to($data['email']);
                            $message->subject('Verification Code');
                            
                     });

                    return response()->json([ 
                    'error' => false,
                    'message' => 'Verification Code Sent to your Email Address',
                    ]);

                }
    }

    public function get_notif($id)
    {
       $notifications = AppNotifications::where('customer_id', $id)
       ->orderBy('created_at', 'desc')
       ->get()->toArray();

       $count = AppNotifications::where([
           ['customer_id', $id],
           ['status', '1']
       ])->count();
       

       return response()->json([ 
        'error' => false,
        'notifications' => $notifications,
        'count' => $count
        ]);
    }

    public function read_notif($id)
    {
        $notification = AppNotifications::where([
            ['customer_id', $id],
            ['status', '1']
        ])->get();
        foreach ($notification as $notif) {
            $notif->status = 0;

            $notif->save();
        }
        

        return response()->json([ 
            'error' => false,
            'notifications' => $notification
        ]);
    }

    // L - 20.5
    // B - 34.5
    // TH- 25.5

   

}
