<?php

namespace App\Http\Controllers;

use Session;
use App\HomeStyling;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeStylingController extends Controller
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

        $homestyling = HomeStyling::all();
		
        $admins = Admin::all();
        
        return view('admin_home_request')->with(['user'=> $user,'admins'=> $admins, 'homestyling'=> $homestyling]);

    }

    public function updateAdmin(Request $request)
    {
        $homestyling = HomeStyling::where('id', $request->input('id'))->first();

        $homestyling->in_charge = $request->input('in_charge');

        if($homestyling->save()){
            Session::flash('success', $homestyling->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $homestyling = HomeStyling::where('id', $request->input('id'))->first();

        $homestyling->status = $request->input('status');

        if($homestyling->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }
    public function storeHome(Request $request)
    {
        if ($request->input('project_type') == 'Others') {

            $date = implode(" ",$request->input('date'));

            $parts = explode(' ', $date);

            $start_date = $parts[0];

            $end_date = $parts[1];


            $home_styling = new HomeStyling;

            $home_styling->customer_id = $request->input('customer_id');

            $home_styling->project_type = $request->input('other');

            $home_styling->service = $request->input('service');

            $home_styling->location = $request->input('location');

            $home_styling->list_of_rooms = $request->input('list_of_rooms');

            $home_styling->general_scope = $request->input('general_scope');

            $home_styling->involvement = $request->input('inv_level');

            $home_styling->expectations = $request->input('expectations');

            $home_styling->start_date = $start_date;

            $home_styling->end_date = $end_date;

            $home_styling->preffered_style = $request->input('preffered_style');

            $home_styling->budget = $request->input('budget');

            $home_styling->status = 'Pending';

            if ($home_styling->save()) {
                
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
        else{

            $home_styling = new HomeStyling;

            $date = implode(" ",$request->input('date'));

            $parts = explode(' ', $date);

            $start_date = $parts[0];

            $end_date = $parts[1];
            
            $home_styling->customer_id = $request->input('customer_id');

            $home_styling->project_type = $request->input('project_type');

            $home_styling->service = $request->input('service');

            $home_styling->location = $request->input('location');

            $home_styling->list_of_rooms = $request->input('list_of_rooms');

            $home_styling->general_scope = $request->input('general_scope');

            $home_styling->involvement = $request->input('inv_level');

            $home_styling->expectations = $request->input('expectations');

            $home_styling->start_date = $start_date;

            $home_styling->end_date = $end_date;

            $home_styling->preffered_style = $request->input('preffered_style');

            $home_styling->budget = $request->input('budget');

            $home_styling->status = 'Pending';

            if ($home_styling->save()) {
                
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