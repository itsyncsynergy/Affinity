<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Session;
use Redirect;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Mail;

class UsersController extends Controller{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
    
        // Get all users 
        $users = User::all();

        return response()->json(['error' => false, 'users' => $users], 200);
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function profile(){

    	$user = Auth::user();

    	return view('profile')->with('user', $user);
    }

    function adminAuthenticate(Request $request)
    {

    	$username = $request->input('username');

        $password = $request->input('password');
        
        $user = User::where('username', $username)->first();

        if(empty($user)){
            Session::flash('error', 'Authentication failed. Invalid username');
            return back();
        }
        elseif($user->status == 0){
            Session::flash('error', 'Authentication failed. Your account is up but yet to be activated. Kindly contact the manager!');
            return back();
        }


    	if (Auth::attempt(['username' => $username, 'password' => $password]))
    	{
    		//Authentication passed...

    		$user = Auth::user();

    		return redirect('admin');

    	}

    	Session::flash('error', 'Authentication failed. Ensure you provide valid credentials');
        return back();


    }

    public function resetMail(Request $request){

        
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        
        $user_id = $user->id;

        $token = time();

        $user = User::where('id', $user_id)->first();

        $user->token = $token;

        $user->save();
        
        $sender = 'yinka@theaffinityclub.com';
        
        
 
        $data = [
        'email'=> $email,
        'token'=> $token,
        'date'=>date('Y-m-d')
        
        
        ];
 
        Mail::send('reset-password', $data, function($message) use($data){
            
            $message->from('yinka@theaffinityclub.com', 'Labisys');
            $message->SMTPDebug = 4; 
            $message->to($data['email']);
            $message->subject('Password Recovery');
 
            Session::flash('success', 'An Email has been sent to your account. Pls check to proceed');
        
            return view('login');
        });
    }    
    

    public function logout(){

    	Auth::logout();
        
        return redirect('login');
    }
    
    
    
}
