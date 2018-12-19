<?php

namespace App\Http\Controllers;

use Session;
use App\BespokeTravel;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BespokeTravelsController extends Controller
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

        $bespoke_travel = BespokeTravel::all();
		
        $admins = Admin::all();
        
        return view('admin_bespoke_travel')->with(['user'=> $user,'admins'=> $admins, 'bespoke_travel'=> $bespoke_travel]);

    }

    public function updateAdmin(Request $request)
    {
        $bespokeTravel = BespokeTravel::where('id', $request->input('id'))->first();

        $bespokeTravel->in_charge = $request->input('in_charge');

        if($bespokeTravel->save()){
            Session::flash('success', $bespokeTravel->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $bespokeTravel = BespokeTravel::where('id', $request->input('id'))->first();

        $bespokeTravel->status = $request->input('status');

        if($bespokeTravel->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function saveTravel(Request $request)
    {
        $bespoke = new BespokeTravel;

        $bespoke->customer_id = $request->input('customer_id');

        $bespoke->occassion = $request->input('occassion');

        $bespoke->duration = $request->input('duration');

        $bespoke->group_size = $request->input('group_size');

        $bespoke->date = $request->input('travel_date');

        $bespoke->time = $request->input('travel_time');

        $bespoke->destination = $request->input('destination');

        $bespoke->status = 'Pending';

        if ($bespoke->save()) {
            
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
