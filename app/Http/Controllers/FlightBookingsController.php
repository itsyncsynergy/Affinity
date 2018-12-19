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

    public function saveBooking(Request $request)
    {
        if ($request->input('request_type') == 'Return') {

            // $date = implode(" ",$request->input('flight_date'));

            // $parts = explode(' ', $date);

            // $start_date = $parts[0];

            // $end_date = $parts[1];
            
            $booking = new FlightBooking;

            $booking->customer_id = $request->input('customer_id');

            $booking->request_type = $request->input('request_type');

            $booking->origin = $request->input('origin');

            $booking->pref_airline = $request->input('pref_airline');

            $booking->flier_no = $request->input('flier_no');

            $booking->destination = $request->input('destination');

            $booking->no_of_passengers = $request->input('num_pass');

            $booking->expected_date = $request->input('depart_date');

            $booking->end_date = $request->input('return_date');

            $booking->preffered_cabin = $request->input('cabin');

            $booking->curr = $request->input('curr');

            $booking->status = 'Pending';


            if ($booking->save()) {
                return response()->json([
                    'error' => false,
                    'message' => 'successfully saved'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Unknown error Occured'
                ]);
            }

        } elseif ($request->input('request_type') == 'One-Way') {
            
            $booking = new FlightBooking;

            $booking->customer_id = $request->input('customer_id');

            $booking->request_type = $request->input('request_type');

            $booking->origin = $request->input('origin');

            $booking->flier_no = $request->input('flier_no');

            $booking->pref_airline = $request->input('pref_airline');

            $booking->destination = $request->input('destination');

            $booking->no_of_passengers = $request->input('num_pass');

            $booking->expected_date = $request->input('date');

            $booking->preffered_cabin = $request->input('cabin');

            $booking->curr = $request->input('curr');

            $booking->status = 'Pending';

            if ($booking->save()) {
                return response()->json([
                    'error' => false,
                    'message' => 'successfully saved'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Unknown error Occured'
                ]);
            }
        } 
        elseif ($request->input('request_type') == 'Multi') {

            $flight = $request->input('flight');

            foreach ($flight as $single) {

                $date = $single['date'];
                $origin = $single['origin'];
                $dest = $single['destination'];

                $booking = new FlightBooking;

                $booking->customer_id = $request->input('customer_id');

                $booking->request_type = $request->input('request_type');

                $booking->flier_no = $request->input('flier_no');

                $booking->origin = $origin;

                $booking->pref_airline = $request->input('pref_airline');

                $booking->destination = $dest;

                $booking->no_of_passengers = $request->input('num_pass');

                $booking->expected_date = $date;

                $booking->preffered_cabin = $request->input('cabin');

                $booking->curr = $request->input('curr');

                $booking->status = 'Pending';
                
                $booking->save();
               
        
            }
            return response()->json([
                'error' => false,
                'message' => 'successfully saved'
            ]);
            
        }    

    }


}
