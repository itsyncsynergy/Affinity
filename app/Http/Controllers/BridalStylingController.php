<?php

namespace App\Http\Controllers;

use Session;
use App\BridalStyling;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BridalStylingController extends Controller
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

        $bridalstyling = BridalStyling::all();
		
        $admins = Admin::all();
        
        return view('admin_bridal_request')->with(['user'=> $user,'admins'=> $admins, 'bridalstyling'=> $bridalstyling]);

    }

    public function updateAdmin(Request $request)
    {
        $bridalstyling = BridalStyling::where('id', $request->input('id'))->first();

        $bridalstyling->in_charge = $request->input('in_charge');

        if($bridalstyling->save()){
            Session::flash('success', $bridalstyling->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $bridalstyling = BridalStyling::where('id', $request->input('id'))->first();

        $bridalstyling->status = $request->input('status');

        if($bridalstyling->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function storeBridal(Request $request)
    {

            $bridal = new BridalStyling;
            
            $bridal->customer_id = $request->input('customer_id');

            $bridal->fullname = $request->input('fullname');

            $bridal->service = $request->input('service');

            $bridal->location = $request->input('location');

            $bridal->date = $request->input('date');

            $bridal->time = $request->input('time');

            $bridal->venue = $request->input('venue');

            $bridal->address = $request->input('address');

            $bridal->budget = $request->input('budget');

            $bridal->status = 'Pending';

            if ($bridal->save()) {
                
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