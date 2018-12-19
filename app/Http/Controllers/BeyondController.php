<?php

namespace App\Http\Controllers;

use Session;
use App\Beyond;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeyondController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function requests()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $beyond = Beyond::all();
		
        $admins = Admin::all();
        
        return view('admin_beyond_request')->with(['user'=> $user,'admins'=> $admins, 'beyond'=> $beyond]);

    }

    public function updateAdmin(Request $request)
    {
        $beyond = Beyond::where('id', $request->input('id'))->first();

        $beyond->in_charge = $request->input('in_charge');

        if($beyond->save()){
            Session::flash('success', $beyond->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $beyond = Beyond::where('id', $request->input('id'))->first();

        $beyond->status = $request->input('status');

        if($beyond->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function saveBeyond(Request $request)
    {

            $beyond = new Beyond;
            
            $beyond->customer_id = $request->input('customer_id');

            $beyond->details = $request->input('details');

            $beyond->status = 'Pending';

            if ($beyond->save()) {
                
                return response()->json([
                    'error' => false,
                    'message' => 'Record Saved Successfully'
                ]);

            } else {
                
                return response()->json([
                    'error' => true,
                    'message' => 'Something went Wrong'
                ]);

            }     
        
    }

  
}