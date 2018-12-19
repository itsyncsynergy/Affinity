<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    /**
	 * Handles authentication attempt
	 *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function mobile_login(Request $request){

    	$username = $request->input('username');

        $password = $request->input('password');

    	if (Auth::attempt(['username' => $username, 'password' => $password])){

           $user = Auth::user();
            
        //    $customer = DB::table('customers')->where('user_id', $user->id)->join('users','users.id','=','customers.user_id')->select('customers.*', 'users.*')->first();
            $admins = DB::table('admins')->join('users','users.details_id','=','admins.admin_id')
            ->where('admin_id', $user->details_id)
            ->select('admins.*', 'users.*')->get()->toArray();
        
            return response()->json(['success' => true, 'message' => 'Authentication is successful', 'admins' => $admins],200);

    	}else{		

            return response()->json(['error' => true, 'message' => 'Authentication failed'], 401);
	}
        
    }

    public function mobile_signup(Request $request)
    {
        
    }
}
