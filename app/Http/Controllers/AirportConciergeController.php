<?php

namespace App\Http\Controllers;

use Session;
use App\AirportConcierge;
use App\Departure;
use App\Arrival;
use App\RoundTrip;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AirportConciergeController extends Controller
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

        $airportConcierge = AirportConcierge::all();
		
        $admins = Admin::all();
        
        return view('admin_airport_concierge')->with(['user'=> $user,'admins'=> $admins, 'airport_concierge'=> $airportConcierge]);

    }

    public function updateAdmin(Request $request)
    {
        $airport_concierge = AirportConcierge::where('id', $request->input('id'))->first();

        $airport_concierge->in_charge = $request->input('in_charge');

        if($airport_concierge->save()){
            Session::flash('success', $airport_concierge->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $airport_concierge = AirportConcierge::where('id', $request->input('id'))->first();

        $airport_concierge->status = $request->input('status');

        if($airport_concierge->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function saveConcierge(Request $request)
    {
        $concierge = new AirportConcierge;

        $service = $request->input('service');

        $additional = implode(', ', array_map(function($entry) {
            return $entry['name'];
        }, $service));

        $concierge->customer_id = $request->input('customer_id');

        $concierge->service = $request->input('request_type');

        $concierge->airport1 = $request->input('airport');

        $concierge->airline = $request->input('airline');

        $concierge->class = $request->input('class');

        $concierge->no_of_passengers = $request->input('num_pass');

        $concierge->date = $request->input('date');

        $concierge->time = $request->input('time');

        $concierge->additional_service = $additional;

        $concierge->others = $request->input('others');

        $concierge->status = 'Pending';

        if ($concierge->save()) {
            
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
