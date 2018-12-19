<?php

namespace App\Http\Controllers;

use Session;
use App\TravelConcierge;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TravelConciergeController extends Controller
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

        $travel = DB::table('travel_concierges')->leftJoin('customers','travel_concierges.customer_id', '=',  'customers.customer_id')->select('customers.*',  'travel_concierges.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_travel_concierge')->with(['user'=> $user,'admins'=> $admins, 'travel'=> $travel]);

    }

    public function updateAdmin(Request $request)
    {
        $travel = TravelConcierge::where('id', $request->input('id'))->first();

        $travel->in_charge = $request->input('in_charge');

        if($travel->save()){
            Session::flash('success', $travel->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $travel = TravelConcierge::where('id', $request->input('id'))->first();

        $travel->status = $request->input('status');

        if($travel->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }


    public function storeConcierge(Request $request)
    {
        
        if ($request->input('service') == 'Others') {

            $travel = new TravelConcierge;

            $travel->customer_id = $request->input('customer_id');

            $travel->location = $request->input('location');

            $travel->service = $request->input('other_service');

            $travel->date = $request->input('date');

            $travel->time = $request->input('time');

            $travel->meeting_point = $request->input('meeting_point');

            $travel->others = $request->input('others');

            $travel->status = 'Pending';

            if ($travel->save()) {
            
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
            
        } else {

            $travel = new TravelConcierge;
            
            $travel->customer_id = $request->input('customer_id');

            $travel->location = $request->input('location');

            $travel->service = $request->input('service');

            $travel->date = $request->input('date');

            $travel->time = $request->input('time');

            $travel->meeting_point = $request->input('meeting_point');

            $travel->others = $request->input('others');

            $travel->status = 'Pending';

            if ($travel->save()) {
                
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

  
}
