<?php

namespace App\Http\Controllers;

use Session;
use App\Subscription;
use App\MerchantOffer;
use App\Merchant;
use App\Transaction;
use App\Customer;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mail;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        //$vpas = Subscription::all();
		
        $subscriptions = DB::table('subscriptions')->leftjoin('customers','customers.customer_id','=','subscriptions.customer_id')->select('customers.*', 'subscriptions.*')->get()->toArray();
        //Subscription::all();
        
        return view('admin_subscriptions')->with(['user'=> $user,'subscriptions'=> $subscriptions]);

    }

    public function DoSub($id)
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        // $customers = Customer::all();

        $admins = Admin::all();

        $customer_id = $id;

        return view('admin_subscription_create')->with(['user'=> $user, 'admins' => $admins, 'customer_id' => $customer_id]);
    }



    public function ViewSub()
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customers = Customer::all();

        $admins = Admin::all();

        return view('admin_subscriptions_new')->with(['user'=> $user, 'customers' => $customers, 'admins' => $admins]);
    }

    public function store(Request $request)
    {
        $user = Subscription::where('customer_id', $request->input('customer_id'))->first();
        if ($user) {

            $subscription = Subscription::where('customer_id', $request->input('customer_id'))->first();

            $subscription->customer_id = $request->input('customer_id');

            $subscription->amount = $request->input('amount');

            $subscription->payment_by = $request->input('paid_by');

            $subscription->Period = $request->input('period');

            $subscription->status = 1;

            $subscription->start_date = substr( $request->input('date'), 0,10 );

            $subscription->end_date = substr($request->input('date'), 13,21 + 1);

            $subscription->membership = $request->input('mem_type');

            if ($subscription->save()) {

                $customer = Customer::where('customer_id', $request->input('customer_id'))->first();
    
                if ($request->input('mem_type') == 'Essence') {
    
                    $customer->membership_id = 1;
    
                    $customer->membership = $request->input('mem_type');
    
                }elseif ($request->input('mem_type') == 'Premium') {
    
                    $customer->membership_id = 2;
    
                    $customer->membership = $request->input('mem_type');
    
                }elseif ($request->input('mem_type') == 'Luxe') {
    
                    $customer->membership_id = 3;
    
                    $customer->membership = $request->input('mem_type');
    
                }else{
                    $customer->membership_id = 0;
    
                    $customer->membership = '';
                }
    
                if ($customer->save()) {
                    
                    Session::flash('success',  'Subscription has been created');
    
                    return back();
    
                }
                else{
    
                    Session::flash('error',  'Error occured');
    
                    return back();
                }
                
            }

        }
        else {

            $subscription = new Subscription;

            $subscription->customer_id = $request->input('customer_id');
    
            $subscription->amount = $request->input('amount');
    
            $subscription->payment_by = $request->input('paid_by');
    
            $subscription->Period = $request->input('period');
    
            $subscription->status = 1;
    
            $subscription->start_date = substr( $request->input('date'), 0,10 );
    
            $subscription->end_date = substr($request->input('date'), 13,21 + 1);
    
    
            $subscription->membership = $request->input('mem_type');

            if ($subscription->save()) {

                $customer = Customer::where('customer_id', $request->input('customer_id'))->first();
    
                if ($request->input('mem_type') == 'Essence') {
    
                    $customer->membership_id = 1;
    
                    $customer->membership = $request->input('mem_type');
    
                }elseif ($request->input('mem_type') == 'Premium') {
    
                    $customer->membership_id = 2;
    
                    $customer->membership = $request->input('mem_type');
    
                }elseif ($request->input('mem_type') == 'Luxe') {
    
                    $customer->membership_id = 3;
    
                    $customer->membership = $request->input('mem_type');
    
                }else{
                    $customer->membership_id = 0;
    
                    $customer->membership = '';
                }
    
                if ($customer->save()) {
                    
                    Session::flash('success',  'Subscription has been created');
    
                    return back();
    
                }
                else{
    
                    Session::flash('error',  'Error occured');
    
                    return back();
                }
                
            }
        }
       
    }

    public function update(Request $request)
    {
        $subscriptions = Subscription::where('subscription_id', $request->input('sub_id'))->first();

        $subscriptions->end_date = $request->input('date');

        $subscriptions->amount = $request->input('amount');

        $subscriptions->membership = $request->input('mem');

        $subscriptions->Period = $request->input('period');

        $subscriptions->status = $request->input('status');

        if($subscriptions->save()){
            Session::flash('success', 'Records has been updated Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not update Records');
            return back();
        } 
    }

    public function checkSub($id, $offer_id)
    {
        $today = date('Y-m-d');

        $userSub = $this->getUserSubData($id);

        if ($userSub) {

                if ($today <= $userSub->end_date) {

                   if ($this->checkUserValidity($userSub->membership, $offer_id)) {

                        $offerTarget = MerchantOffer::where('offer_id', $offer_id)->first();

                        $merchant = Merchant::where('merchant_id', $offerTarget->merchant_id)->first();

                       return response()->json([
                                            'code' => 200,
                                            'message' => 'You are eligible for this offer.',
                                            'verification_pin' => $merchant->verification_pin,
                                        ], 200);
                   }else {
                    $offerTarget = MerchantOffer::where('offer_id', $offer_id)->first();

                    $merchant = Merchant::where('merchant_id', $offerTarget->merchant_id)->first();

                    $name = $merchant->name;

                    $customer = Customer::where('customer_id', $id)->first();
                    $email = $customer->email;
                    $first = $customer->firstname;
                        $data = [
                            'email'=> $email,
                            'name' => $name,
                            'first' => $first,
                            'date' =>date('Y-m-d')
                            ];
                    
                            Mail::send('emails.redeem', $data, function($message) use($data){
                                
                                $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                                $message->SMTPDebug = 4; 
                                $message->to($data['email']);
                                $message->subject('Redemption Notification');
                                
                        });
                       return response()->json([
                                            'code' => 101,
                                            'error' => true,
                                            'message' => 'You are not eligible for this offer.',
                                            // 'verification_pin' => $merchant->verification_pin,
                                        ], 200);
                   }
               }else{
                $offerTarget = MerchantOffer::where('offer_id', $offer_id)->first();

                $merchant = Merchant::where('merchant_id', $offerTarget->merchant_id)->first();

                $name = $merchant->name;

                $customer = Customer::where('customer_id', $id)->first();
                $email = $customer->email;
                $first = $customer->firstname;
                    $data = [
                        'email'=> $email,
                        'name' => $name,
                        'first' => $first,
                        'date' =>date('Y-m-d')
                        ];
                
                        Mail::send('emails.redeem', $data, function($message) use($data){
                            
                            $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                            $message->SMTPDebug = 4; 
                            $message->to($data['email']);
                            $message->subject('Redemption Notification');
                            
                    });
                        return response()->json([
                                    'code' => 100,
                                    'error' => true,
                                    'message' => 'You subscription has expired, renew.',
                                    'today' => $today,
                                    'end_date' => $userSub->end_date,

                                ], 200);
                }
        }else{
            $offerTarget = MerchantOffer::where('offer_id', $offer_id)->first();

            $merchant = Merchant::where('merchant_id', $offerTarget->merchant_id)->first();

            $name = $merchant->name;

            $customer = Customer::where('customer_id', $id)->first();
            $email = $customer->email;
            $first = $customer->firstname;
                $data = [
                    'email'=> $email,
                    'name' => $name,
                    'first' => $first,
                    'date' =>date('Y-m-d')
                    ];
            
                    Mail::send('emails.redeem', $data, function($message) use($data){
                        
                        $message->from('adedotun.kasim@itsync.ng', 'Dotman');
                        $message->SMTPDebug = 4; 
                        $message->to($data['email']);
                        $message->subject('Redemption Notification');
                        
                });
                return response()->json([
                                    'code' => 404,
                                    'error' => true,
                                    'message' => 'No Subscription',
                                ], 200);
            }
               
    }

    public function getUserSubData($id)
    {
        $userSub = Subscription::where('customer_id', $id)->first();

        return $userSub;
    }

    public function checkUserValidity($membership, $offer_id)
    {
        // $offerTarget = MerchantOffer::where('offer_id', $offer_id)->first();

        $offerTarget = DB::table('merchant_offers')
        ->join('offer_target', 'merchant_offers.offer_id', '=', 'offer_target.offer_id')
        ->select('offer_target.target_members')
        ->where('offer_target.offer_id', $offer_id)
        ->get()
        ->toArray();

        if (is_array($offerTarget)) {
           foreach ($offerTarget as $otarget) {
               if ($otarget->target_members == $membership) {
                    return true;
               }
               elseif ($membership == 'Luxe' && $otarget->target_members == 'Premium' || $otarget->target_members == 'Essence') {
                    return true;
               }
               elseif ($membership == 'Premium' && $otarget->target_members == 'Essence') {
                    return true;
               }
               else {
                   return false;
               }
           }
        }


    }

    public function PostTrans(Request $request)
    {
        

        $merchant = $request->input('merchant_id');

        // $merchant_id = $merchant['id'];
        if (is_array($merchant)) {
            $merchant_id = $merchant['id'];
        }else {
            $merchant_id = $request->input('merchant_id');
        }

        $amount = $request->input('amount');

        $payable = $request->input('amount_payable');

        $offer_id = $request->input('offer_id');

        $customer_id = $request->input('customer_id');

        $getOffer = MerchantOffer::where('offer_id', $offer_id)->first();

        $offer_type = $getOffer->offer_type;

        $offer = $getOffer->offer_name;

        $offer_details = $getOffer->tagline;

        if ($offer_type == 'Percentage discount') {

            $topay = ($offer * $amount)/100;

            if ($payable == $topay) {

                    $transaction = new Transaction;

                    $transaction->customer_id = $customer_id;

                    $transaction->merchant_id = $merchant_id;

                    $transaction->amount = $amount;

                    $transaction->transaction_type = $offer_details;

                    $transaction->offer = $offer;

                    $transaction->offer_id = $offer_id;

                    $transaction->save();

                    $redemption = DB::table('merchant_offers')
                    ->join('transactions', 'merchant_offers.merchant_id', '=', 'transactions.merchant_id')
                    ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
                    ->select('merchant_offers.*', 'merchants.name')
                    ->where('transactions.customer_id',  $customer_id)
                    ->get();

                    return response()->json([
                                    'error' => false,
                                    'code' => 200,
                                    'message' => 'Transaction is successful',
                                    'redemption' => $redemption
                                    
                                ]);
                } else {
                    
                    return response()->json([
                                     'error' => true,
                                     'code' => 502,
                                     'message' => 'Not Successful'
                                ]);
            }

        } elseif ($offer_type == 'Amount discount') {

            $topay = $amount - $offer;

            if ($payable == $topay) {

                    $transaction = new Transaction;

                    $transaction->customer_id = $customer_id;

                    $transaction->merchant_id = $merchant_id;

                    $transaction->amount = $amount;

                    $transaction->transaction_type = $offer_details;

                    $transaction->offer = $offer;

                    $transaction->offer_id = $offer_id;

                    $transaction->save();

                    $redemption = DB::table('merchant_offers')
                    ->join('transactions', 'merchant_offers.merchant_id', '=', 'transactions.merchant_id')
                    ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
                    ->select('merchant_offers.*', 'merchants.name')
                    ->where('transactions.customer_id',  $customer_id)
                    ->get();

                    return response()->json([
                                     'error' => false,
                                     'code' => 200,
                                     'message' => 'Transaction is successful',
                                     'redemption' => $redemption
                                ]);
                } else {
                    
                    return response()->json([
                                     'error' => true,
                                    'code' => 502,
                                    'message' => 'Not Successful'
                                ]);
            }
        }
        else {

            $topay = $amount;

                    $transaction = new Transaction;

                    $transaction->customer_id = $customer_id;

                    $transaction->merchant_id = $merchant_id;

                    $transaction->amount = $amount;

                    $transaction->transaction_type = $offer_details;

                    $transaction->offer = $offer;

                    $transaction->offer_id = $offer_id;

                    $transaction->save();

                    $redemption = DB::table('merchant_offers')
                    ->join('transactions', 'merchant_offers.merchant_id', '=', 'transactions.merchant_id')
                    ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
                    ->select('merchant_offers.*', 'merchants.name')
                    ->where('transactions.customer_id',  $customer_id)
                    ->get();

                    return response()->json([
                                     'error' => false,
                                     'code' => 200,
                                     'message' => 'Transaction is successful',
                                     'redemption' => $redemption
                                ]);
        }
        

    }

    public function saveReviews(Request $request)
    {
       $review = Transaction::where([
           ['customer_id', '=', $request->input('customer_id')],
           ['merchant_id', '=', $request->input('merchant_id')]
       ])->latest()->first();

       if ($review){
            $review->remarks = $request->input('remarks');

            if ($review->save()){
                return response()->json([
                    'error' => false,
                    'message' => 'Thanks for your review'   
                ]);
            }
       }

       
    }

    public function MakeSubscription(Request $request)
    {
        $customer_id = $request->input('customer_id');

        $amount = $request->input('amount');

        $membership = $request->input('membership');

        $today = date('Y-m-d');

        //check inout from api 

        if ($request->input('plans') == 'Essence_Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();
            
        } else if ($request->input('plans') == 'Essence_Yearly') {
            
            $plan = 'Yearly';

            $expiry = $this->Yearly();

        } else if ($request->input('plans') == 'Luxe_Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();

        } elseif ($request->input('plans') == 'Luxe_Yearly') {

            $plan = 'Yearly';

            $expiry = $this->Yearly();

        } else if ($request->input('plans') == 'Premium_Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();
           
        } else if ($request->input('plans') == 'Premium_Yearly') {

            $plan = 'Yearly';

            $expiry = $this->Yearly();
        } 

      //Store details

        $subscription = new Subscription;

        $subscription->customer_id = $customer_id;

        $subscription->amount = $amount;

        $subscription->payment_by = 'Self';

        $subscription->Period = $plan;

        $subscription->status = 1;

        $subscription->start_date = $today;

        $subscription->end_date = $expiry;

        $subscription->membership = $membership;

        if ($subscription->save()) {

            $customer = Customer::where('customer_id', $customer_id)->first();

            if ($membership == 'Essence') {

                $customer->membership_id = 1;

                $customer->membership = $membership;

            }elseif ($membership == 'Premium') {

                $customer->membership_id = 2;

                $customer->membership = $membership;

            }elseif ($membership == 'Luxe') {

                $customer->membership_id = 3;

                $customer->membership = $membership;

            }

            if ($customer->save()) {
                
                 $sub = Subscription::where('customer_id', $customer_id)->first();

                 if ($sub) {
                        if ($today <= $sub->end_date ) {

                        $date = date_create($sub->end_date);

                        $new = date_format($date, "F d, Y");

                        $message = 'Your Subscription will Expire on'.' '. $new;

                        $sub['expiry_message'] = $message;

                        
                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                        } 
                        else {

                            $date = date_create($sub->end_date);

                            $new = date_format($date, "F d, Y");

                            $message = 'Your Subscription expired on '.' '. $new;

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                        }

                } else {

                            $message = 'No Subscription';

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                }

            }
            else{

                 return response()->json([
                    'error' => true,
                    'message' => 'Error Occurred'
                ]);
            }
            
        }
        
           
    }

    public function Monthly()
    {
        $today = date('Y-m-d');

        $date=date_create($today);

        date_add($date, date_interval_create_from_date_string("30 days"));

        $new = date_format($date,"Y-m-d");

        return $new;
    }

    public function Yearly()
    {
        $today = date('Y-m-d');

        $date=date_create($today);

        date_add($date, date_interval_create_from_date_string("365 days"));

        $new = date_format($date,"Y-m-d");

        return $new;
    }

    public function change_plan(Request $request)
    {
        $customer_id = $request->input('customer_id');

        $amount = $request->input('amount');

        $membership = $request->input('membership');

        $today = date('Y-m-d');

         //check inout from api 

        if ($request->input('plans') == 'Essence_Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();
            
        } else if ($request->input('plans') == 'Essence_Yearly') {
            
            $plan = 'Yearly';

            $expiry = $this->Yearly();

        } else if ($request->input('plans') == 'Luxe_Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();

        } elseif ($request->input('plans') == 'Luxe_Yearly') {

            $plan = 'Yearly';

            $expiry = $this->Yearly();

        } else if ($request->input('plans') == 'Premium_Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();
           
        } else if ($request->input('plans') == 'Premium_Yearly') {

            $plan = 'Yearly';

            $expiry = $this->Yearly();
        } 

        $subscription = Subscription::where('customer_id', $customer_id)->first();

        $subscription->amount = $amount;

        $subscription->payment_by = 'Self';

        $subscription->Period = $plan;

        $subscription->status = 1;

        $subscription->start_date = $today;

        $subscription->end_date = $expiry;

        $subscription->membership = $membership;

        if ($subscription->save()) {

            $customer = Customer::where('customer_id', $customer_id)->first();

            if ($membership == 'Essence') {

                $customer->membership_id = 1;

                $customer->membership = $membership;

            }elseif ($membership == 'Premium') {

                $customer->membership_id = 2;

                $customer->membership = $membership;

            }elseif ($membership == 'Luxe') {

                $customer->membership_id = 3;

                $customer->membership = $membership;

            }

            if ($customer->save()) {

                 $sub = Subscription::where('customer_id', $customer_id)->first();

                 if ($sub) {
                        if ($today <= $sub->end_date ) {

                        $date = date_create($sub->end_date);

                        $new = date_format($date, "F d, Y");

                        $message = 'Your Subscription will Expire on'.' '. $new;

                        $sub['expiry_message'] = $message;

                        
                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                        } 
                        else {

                            $date = date_create($sub->end_date);

                            $new = date_format($date, "F d, Y");

                            $message = 'Your Subscription expired on '.' '. $new;

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                        }

                } else {

                            $message = 'No Subscription';

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                }


            }
            else{

                 return response()->json([
                    'error' => true,
                    'message' => 'Error Occurred'
                ]);
            }
            
        }


    }

    public function sub_details($id)
    {
        $today = date('Y-m-d');

        $sub = Subscription::where('customer_id', $id)->first();

                 if ($sub) {
                        if ($today <= $sub->end_date ) {

                        $date = date_create($sub->end_date);

                        $new = date_format($date, "F d, Y");

                        $message = 'Your Subscription will Expire on'.' '. $new;

                        $sub['expiry_message'] = $message;

                        
                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                
                            ]);

                        } 
                        else {

                            $date = date_create($sub->end_date);

                            $new = date_format($date, "F d, Y");

                            $message = 'Your Subscription expired on '.' '. $new;

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                
                            ]);

                        }

                }else{
                    $sub = null;
                    return response()->json([
                        'error' => false,
                        'subscription' => $sub,
                        
                    ]);
                }


    }

    public function Renew_plan(Request $request)
    {
        $customer_id = $request->input('customer_id');

        $amount = $request->input('amount');

        $membership = $request->input('membership');

        $today = date('Y-m-d');

        if ($request->input('plans') == 'Monthly') {

            $plan = 'Monthly';

            $expiry = $this->Monthly();
            
        } else if ($request->input('plans') == 'Yearly') {
            
            $plan = 'Yearly';

            $expiry = $this->Yearly();

        } 

        $subscription = Subscription::where('customer_id', $customer_id)->first();

        $subscription->amount = $amount;

        $subscription->payment_by = 'Self';

        $subscription->Period = $plan;

        $subscription->status = 1;

        $subscription->start_date = $today;

        $subscription->end_date = $expiry;

        $subscription->membership = $membership;

        if ($subscription->save()) {

            $customer = Customer::where('customer_id', $customer_id)->first();

            if ($membership == 'Essence') {

                $customer->membership_id = 1;

                $customer->membership = $membership;

            }elseif ($membership == 'Premium') {

                $customer->membership_id = 2;

                $customer->membership = $membership;

            }elseif ($membership == 'Luxe') {

                $customer->membership_id = 3;

                $customer->membership = $membership;

            }

            if ($customer->save()) {

                 $sub = Subscription::where('customer_id', $customer_id)->first();

                 if ($sub) {
                        if ($today <= $sub->end_date ) {

                        $date = date_create($sub->end_date);

                        $new = date_format($date, "F d, Y");

                        $message = 'Your Subscription will Expire on'.' '. $new;

                        $sub['expiry_message'] = $message;

                        
                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                        } 
                        else {

                            $date = date_create($sub->end_date);

                            $new = date_format($date, "F d, Y");

                            $message = 'Your Subscription expired on '.' '. $new;

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                        }

                } else {

                            $message = 'No Subscription';

                            $sub['message'] = $message;

                            return response()->json([
                                'error' => false,
                                'subscription' => $sub,
                                'message' => 'Payment Made Successfully'
                            ]);

                }


            }
            else{

                 return response()->json([
                    'error' => true,
                    'message' => 'Error Occurred'
                ]);
            }
            
        }




    }

}
