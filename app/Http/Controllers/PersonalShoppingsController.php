<?php

namespace App\Http\Controllers;

use Session;
use App\PersonalShopping;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalShoppingsController extends Controller
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

        $personal_shoppings =  DB::table('personal_shoppings')->leftJoin('customers','personal_shoppings.customer_id', '=',  'customers.customer_id')->select('customers.*',  'personal_shoppings.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_personal_shoppings')->with(['user'=> $user,'admins'=> $admins, 'personal_shoppings'=> $personal_shoppings]);

    }

    

    public function updateAdmin(Request $request)
    {
        $personal_shopping = PersonalShopping::where('id', $request->input('id'))->first();

        $personal_shopping->in_charge = $request->input('in_charge');

        if($personal_shopping->save()){
            Session::flash('success', $personal_shopping->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $personal_shopping = PersonalShopping::where('id', $request->input('id'))->first();

        $personal_shopping->status = $request->input('status');

        if($personal_shopping->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function personalShop()
    {
        # code...
    }

    
}
