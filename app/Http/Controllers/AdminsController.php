<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\AirportConcierge;
use App\BespokeTravel;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;



class AdminsController extends Controller
{
	public function index(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->orderBy('id', 'desc')->first();

        $vpas = DB::table('vpas')->leftJoin('customers','vpas.customer_id', '=',  'customers.customer_id')->select('customers.*',  'vpas.*')->get()->toArray();
        $rentals = DB::table('rentals')->orderBy('created_at', 'desc')->get();
        $airportConcierge = AirportConcierge::all();
        $bespoke_product_requests = DB::table('bespoke_product_requests')->join('customers','customers.customer_id','=','bespoke_product_requests.customer_id')->join('bespoke_products','bespoke_products.id','=','bespoke_product_requests.bespoke_product_id')->select('customers.phone','customers.firstname', 'customers.lastname', 'bespoke_products.*', 'bespoke_product_requests.*')->get()->toArray();
		$waitlisted_product_requests = DB::table('waitlisted_product_requests')->join('customers','customers.customer_id','=','waitlisted_product_requests.customer_id')->join('waitlisted_products','waitlisted_products.id','=','waitlisted_product_requests.waitlisted_product_id')->select('customers.phone','customers.firstname', 'customers.lastname', 'waitlisted_products.*', 'waitlisted_product_requests.*')->get()->toArray();
        $bespoke_travel = BespokeTravel::all();
        $requests = DB::table('customer_luxury_experiences')->leftJoin('customers','customer_luxury_experiences.customer_id', '=',  'customers.customer_id')->join('luxury_experiences','luxury_experiences.experience_id', '=',  'customer_luxury_experiences.experience_id')->select('customers.*',  'customer_luxury_experiences.*', 'luxury_experiences.*')->get()->toArray();
		$flight_bookings = DB::table('flight_bookings')->leftJoin('customers','flight_bookings.customer_id', '=',  'customers.customer_id')->select('customers.*',  'flight_bookings.*')->get()->toArray();
		$events = DB::table('globalvipevents_info_requests')->leftJoin('customers','globalvipevents_info_requests.customer_id', '=',  'customers.customer_id')->join('vip_events','vip_events.id', '=',  'globalvipevents_info_requests.vip_event_id')->select('customers.*',  'globalvipevents_info_requests.*', 'vip_events.*', 'vip_events.id as event_id')->get()->toArray();
		$p_events = DB::table('privateparty_info_requests')->leftJoin('customers','privateparty_info_requests.customer_id', '=',  'customers.customer_id')->join('private_parties','private_parties.id', '=',  'privateparty_info_requests.private_party_id')->select('customers.*',  'privateparty_info_requests.*', 'privateparty_info_requests.id as event_id', 'private_parties.*')->get()->toArray();
		
        
        //$admins = DB::table('admins')->join('users','users.details_id','=','admins.admin_id')->select('admins.*', 'users.*')->get()->toArray();
		

        return view('admin_index')->with(['user'=> $user, 'p_events'=> $p_events, 'events'=> $events, 'flight_bookings'=> $flight_bookings, 'vpas'=> $vpas, 'rentals'=> $rentals, 'airport_concierge'=> $airportConcierge,'bespoke_product_requests'=> $bespoke_product_requests, 'waitlisted_product_requests'=> $waitlisted_product_requests, 'bespoke_travel'=> $bespoke_travel, 'requests'=> $requests,  /*, 'admins'=> $admins*/]);

	
    }

    public function newAdmin(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        //$admins = DB::table('admins')->join('users','users.details_id','=','admins.admin_id')->select('admins.*', 'users.*')->get()->toArray();
		

        return view('admin_admin_new')->with(['user'=> $user/* 'admins'=> $admins*/]);

	
    }

    public function admins(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $admins = DB::table('admins')->join('users','users.details_id','=','admins.admin_id')->select('admins.*', 'users.*')->get()->toArray();
		

        return view('admin_admins')->with(['user'=> $user, 'admins'=> $admins]);

	
    }

    public function activateAccount($id){

        //$user = Auth::user();

        $user = User::findOrFail($id);

        $user->status = 1;
		
        if($user->save()){
            Session::flash('success', 'Account has been activated');
            return back();
        }else{
            Session::flash('error', 'Could not update admin profile');
            return back();
        }    	
    }

    public function deactivateAccount($id){

        //$user = Auth::user();

        $user = User::findOrFail($id);

        $user->status = 0;
		
        if($user->save()){
            Session::flash('success', 'Account has been deactivated');
            return back();
        }else{
            Session::flash('error', 'Could not update admin profile');
            return back();
        }    	
    }
    
    public function store(Request $request)
    {
        //
        $admin = new Admin;

        // fake admin id...

        $admin->admin_id = 'AD'.time();   
        //$customer->customer_id = $request->input('customer_id');

        $admin->name = $request->input('name');

        $admin->address = $request->input('address');

        $admin->phone = $request->input('phone');

        $admin->email = $request->input('email');

        //$admin->status = 'Active';
		
		$admin->state = $request->input('state');
		
		//$admin->country = $request->input('country');
		
		$admin->admin_type = $request->input('admin_type');

        $avatar = $request->file('avatar'); 

        $admin->avatar = $request->input('avatar');

        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $admin->avatar = $path;
        
        if ($admin->save())
        {

            // Create Login account

            $user = new User;

            $user->username = $request->input('email');
            $user->password = bcrypt('password');
            $user->group_id = 3; // 3 for admin profile
            $user->details_id = $admin->admin_id; 
            $user->user_type = 'admin';   

            if($user->save()){
                Session::flash('success', 'Admin profile created');
                return back();
            }else{
                Session::flash('error', 'Could not create admin profile');
                return back();
            }    

        }else{
            Session::flash('error', 'Could not create admin profile');
            return back();
        }

    }
	
	public function create(Request $request)
    {
        $user = new User;
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->status = 1; // Verified
        $user->user_type = 1; // 1 for admin profile
        
        if($user->save()){
            
            $admin = new Admin;
            
            $admin->user_id = $user->id;    

            $admin->name = $request->input('name');

            $admin->phone = $request->input('phone');

            $admin->email = $request->input('email');

            $admin->staff_id = $request->input('staff_id');

            $avatar = $request->file('profile_picture'); 

            $filename = time();

            $extension = $avatar->extension();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
        
            if ($request->file('profile_picture')->isValid()) {
                
                $admin->avatar = $path;

            }

            if($admin->save()){
                Session::flash('success', 'Congrats! New record saved');
                return back();
            }
            else{
                Session::flash('error', 'Ooops! An error occured');
                return back();
            }
        }   
        else{
            Session::flash('error', 'Ooops! An error occured');
            return back();
        } 

    }
	
	public function destroy($id)
    {
        //
        try
        {

            $admin = Admin::findOrFail($id);


            if ($admin->delete())
            {


            $user = User::findByDetailsId($id);

            $user->delete();

            return response()->json(['error' => false, 'message' => 'Admin record deleted successfully'],200);
            
            }

            return response()->json(['error' => true, 'message' => 'Admin record could not be deleted'],200);
        
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }

    }

	
    public function show($id)
    {
        //
      try
        {
            $admin = Admin::findOrFail($id);

            return response()->json(['error' => false, 'admin' => $admin],200);

        }

        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }



    }
    
    public function update(Request $request, $id)
    {
        $user = User::findByDetailsId($id);
        
        $admin = Admin::findOrFail($id);

            if ($request->has('username'))
            {
                $user->username = $request->input('username');

                if ($request->has('password'))
                    $user->password = bcrypt($request->input('password'));
                    
                 if ($request->has('name'))
                    $admin->name = $request->input('name');
                    
                 if ($request->has('phone'))
                    $admin->phone = $request->input('phone');
                
                 if ($request->has('email'))
                    $admin->email = $request->input('email');
            
            }        
            
            if ($admin->save())
            {
             
               if ($user->save())
               {
                    return response()->json(['error' => false, 'message' => 'User updated successfully with ID: ' . $id],200);
               }
    			else{
    			return response()->json(['error' => true, 'message' => 'Error updating user record'],200);
    
    			}
            }	
    }

	
	
	public function generateAdminID($id)
    {
     
        //$customIdentifier = new CustomIdentifier;

        $generatedID = 'AD'.sprintf('%03d', $id);

        return $generatedID;

    }

    public function generatefakeID()
    {
     
        $fake = time();

        return $fake;
    }
	
}
