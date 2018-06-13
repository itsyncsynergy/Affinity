<?php

namespace App\Http\Controllers;

use Session;
use App\Subscription;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
		
        $subscriptions = DB::table('subscriptions')->join('customers','customers.customer_id','=','subscriptions.customer_id')->select('customers.*', 'subscriptions.*')->get()->toArray();//Subscription::all();
        
        return view('admin_subscriptions')->with(['user'=> $user,'subscriptions'=> $subscriptions]);

    }


}
