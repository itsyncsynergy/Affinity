<?php

namespace App\Http\Controllers;

use Session;
use App\Customer;
use App\Beyond;
use App\RentalRequest;
use App\Countries;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;



class CustomersController extends Controller
{
	public function index(){

        //$user = Auth::user();

        $customers = Customer::all(); //DB::table('admins')->join('users','users.id','=','admins.user_id')->select('admins.*', 'users.*')->get()->toArray();
        
        return response()->json(['customers' => $customers]);

        //return view('admin/index1')->with([/*'user'=> $user,*/ 'admins'=> $admins]);

	
    }

    public function customerHistory($id){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customer = Customer::where('customer_id', $id)->first();

        $redemption = DB::table('transactions')
        ->join('merchants', 'transactions.merchant_id', '=', 'merchants.merchant_id')
        ->select('transactions.*', 'merchants.name as merchant_name')
        ->where('transactions.customer_id', $id)
        ->get();

        

        $beyond = Beyond::where('customer_id', $id)->get()->toArray();

        $rental = DB::table('rental_requests')
        ->join('rentals','rentals.id', '=',  'rental_requests.rental_id')
        ->select('rental_requests.*', 'rentals.name')
        ->where('rental_requests.customer_id', $id)
        ->get();

        $rental = json_decode($rental, true);

        // $rental = RentalRequest::where('customer_id', $id)->get()->toArray();

        $comb = array_merge($beyond, $rental);
        echo json_encode($comb);
        die();

        return view('admin_customers_history')->with(['user'=> $user, 'customer'=> $customer, 'redemptions'=> $redemption, 'comb'=> $comb]); 

    }

    public function fetch($id)
    {
       $customer = Customer::where('customer_id', $id)->first();

       return $customer;
    }
    
    public function customers(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customers = Customer::all();
        
        return view('admin_customers')->with(['user'=> $user, 'customers'=>$customers]);

	
    }

    public function NewCustomer()
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        

        return view('admin_customers_new')->with(['user'=> $user]);
    }

    public function AddCustomer(Request $request)
    {
        $customer = new Customer;
            
            $customer->customer_id = substr(strtoupper($request->input('firstname')), 0,3).'-'.time();

            $customer->firstname = $request->input('firstname');

            $customer->lastname = $request->input('lastname');

            $customer->phone = $request->input('phone');

            $customer->sex = $request->input('sex');

            $customer->email = $request->input('email');

            $customer->address = $request->input('address');

            $customer->country = 'Nigeria';

            $customer->state = $request->input('state');

            $customer->membership = $request->input('mem_type');

            $customer->status = 'Active';

            $avatar = $request->file('avatar'); 
        
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $customer->avatar = $path;
 
        
        if($customer->save()){
            
            $user = new User;
            $user->username = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->group_id = 1;
            $user->status = 1;
            $user->details_id = $customer->customer_id;
            $user->user_type = 'customer';

            if ($user->save()) {

                Session::flash('success',  'User has been created');
                return back();

            }else{

                Session::flash('error', 'An error occured. Could not create Guest');
                return back();
            }
        }
    }
    
    public function activeCustomers(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customers = DB::table('subscriptions')->distinct()->join('customers','customers.customer_id','=','subscriptions.customer_id')
        ->join('users', 'users.details_id', '=', 'customers.customer_id')
        ->select('customers.*', 'subscriptions.*', 'users.*')->orderBy('subscriptions.created_at', 'desc')->get()->toArray();
        
        return view('admin_customers')->with(['user'=> $user, 'customers'=>$customers]);

	
    }
    
    public function guestCustomers(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $countries = Countries::all();

        $customers = DB::table("customers")
        ->join('users', 'customers.customer_id', '=', 'users.details_id')
        ->select('customers.*', 'users.*')->whereNotIn('customer_id',function($query) {

            $query->select('customer_id')->from('subscriptions');
         
         })->get();
        return view('admin_guests')->with(['user'=> $user, 'customers'=>$customers, 'countries' => $countries]);

	
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

    public function guestsNew(){
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $countries = Countries::all();
        

        return view('admin_guests_new')->with(['user'=> $user, 'countries' => $countries]);

    }

   public function deleteCustomers($id)
   {
       $customer = Customer::where('customer_id', $id)->first();

       $user = User::where('details_id', $id)->first();

       $customer->delete();

       $user->delete();

       return back();
   }

    public function store(Request $request)
    {
            $customer = new Customer;
            
            $customer->customer_id = substr(strtoupper($request->input('firstname')), 0,3).'-'.time();

            $customer->firstname = $request->input('firstname');

            $customer->lastname = $request->input('lastname');

            $customer->phone = $request->input('phone');

            $customer->sex = $request->input('sex');

            $customer->email = $request->input('email');

            $customer->address = $request->input('address');

            $customer->membership = $request->input('membership');

            $customer->country = $request->input('country_id');

            $customer->state = $request->input('state');

            $customer->country_code = $request->input('code');

            $customer->status = 'Active';

            $avatar = $request->file('avatar'); 
        
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $customer->avatar = $path;
 
        
        if($customer->save()){
            
            $user = new User;
            $user->username = $request->input('email');
            $user->password = bcrypt($request->input('password'));
            $user->group_id = 1;
            $user->status = 1;
            $user->details_id = $customer->customer_id;
            $user->user_type = 'customer';

            if ($user->save()) {

                Session::flash('success',  'Guest User has been created');
                return back();

            }else{

                Session::flash('error', 'An error occured. Could not create Guest');
                return back();
            }
        }

    }
	
	public function createNew(Request $request)
    {
        $user = new User;
        $user->username = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->status = 2; // Not yet verified
        $user->user_type = 1; // 1 for admin profile
        
        if($user->save()){
            
            $customer = new Customer;
            
            $customer->user_id = $user->id;    

            $customer->firstname = $request->input('firstname');

            $customer->surname = $request->input('lastname');

            //$customer->dob = $request->input('dob');

            $customer->phone = $request->input('phone');

            $customer->gender = $request->input('gender');

            $customer->state = $request->input('state');

            $customer->lga = $request->input('city');

            $customer->email = $request->input('email');

            

            if($customer->save()){
                return response()->json(['success' => true, 'message' => 'Account created successfully. Kindly proceed to login'],200);
            }
            else{
                return response()->json(['error' => true, 'message' => 'An error occured. Please try again'], 200);
            }
        }   
        else{
            return response()->json(['error' => true, 'message' => 'An error occured. Please try again'], 200);
        } 

    }

    public function create(Request $request)
    {
        $user = new User;
        $user->username = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->status = 2; // Not yet verified
        $user->user_type = 2; // 1 for customer profile
        
        if($user->save()){
            
            $customer = new Customer;
            
            $customer->user_id = $user->id;    

            $customer->state = $request->input('state');

            $customer->lga = $request->input('city');

            $customer->branch = $request->input('branch');

            $customer->bet9ja_id = $request->input('bet9ja_id');

            $customer->bet9ja_code = $request->input('bet9ja_code');

            

            if($customer->save()){
                return response()->json(['success' => true, 'message' => 'Account updated successfully. Kindly proceed to login'],200);
            }
            else{
                return response()->json(['error' => true, 'message' => 'An error occured. Please try again'], 200);
            }
        }   
        else{
            return response()->json(['error' => true, 'message' => 'An error occured. Please try again'], 200);
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
	
}
