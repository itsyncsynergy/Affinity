<?php

namespace App\Http\Controllers;

use Session;
use App\Customer;
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
    
    public function customers(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customers = Customer::all();
        
        return view('admin_customers')->with(['user'=> $user, 'customers'=>$customers]);

	
    }
    
    public function activeCustomers(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customers = DB::table('subscriptions')->distinct()->join('customers','customers.customer_id','=','subscriptions.customer_id')->select('customers.*', 'subscriptions.*')->orderBy('subscriptions.created_at', 'desc')->get()->toArray();
        
        return view('admin_customers')->with(['user'=> $user, 'customers'=>$customers]);

	
    }
    
    public function guestCustomers(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $customers = DB::table("customers")->select('*')->whereNotIn('customer_id',function($query) {

            $query->select('customer_id')->from('subscriptions');
         
         })->get();
        return view('admin_guests')->with(['user'=> $user, 'customers'=>$customers]);

	
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
