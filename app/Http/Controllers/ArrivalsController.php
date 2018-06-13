<?php

namespace App\Http\Controllers;

use Session;
use App\Vpa;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArrivalsController extends Controller
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

        $vpas = DB::table('vpas')->leftJoin('customers','vpas.customer_id', '=',  'customers.customer_id')->select('customers.*',  'vpas.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_vpas')->with(['user'=> $user,'admins'=> $admins, 'vpas'=> $vpas]);

    }

    

    public function updateAdmin(Request $request)
    {
        $vpa = Vpa::where('id', $request->input('id'))->first();

        $vpa->in_charge = $request->input('in_charge');

        if($vpa->save()){
            Session::flash('success', $vpa->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $vpa = Vpa::where('id', $request->input('id'))->first();

        $vpa->status = $request->input('status');

        if($vpa->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }


}
