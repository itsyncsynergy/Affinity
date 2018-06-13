<?php

namespace App\Http\Controllers;

use Session;
use App\FlightBooking;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightBookingsController extends Controller
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

        $flight_bookings = DB::table('flight_bookings')->leftJoin('customers','flight_bookings.customer_id', '=',  'customers.customer_id')->select('customers.*',  'flight_bookings.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_flight_bookings')->with(['user'=> $user,'admins'=> $admins, 'flight_bookings'=> $flight_bookings]);

    }

    

    public function updateAdmin(Request $request)
    {
        $flight_booking = FlightBooking::where('id', $request->input('id'))->first();

        $flight_booking->in_charge = $request->input('in_charge');

        if($flight_booking->save()){
            Session::flash('success', $flight_booking->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $flight_booking = FlightBooking::where('id', $request->input('id'))->first();

        $flight_booking->status = $request->input('status');

        if($flight_booking->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }


}
