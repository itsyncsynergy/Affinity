<?php

namespace App\Http\Controllers;

use Session;
use App\PersonalStyling;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonalStylingController extends Controller
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

        $personal = PersonalStyling::all();
		
        $admins = Admin::all();
        
        return view('admin_personal_request')->with(['user'=> $user,'admins'=> $admins, 'personal'=> $personal]);

    }

    public function updateAdmin(Request $request)
    {
        $experience = PersonalStyling::where('id', $request->input('id'))->first();

        $experience->in_charge = $request->input('in_charge');

        if($experience->save()){
            Session::flash('success', $experience->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $experience = PersonalStyling::where('id', $request->input('id'))->first();

        $experience->status = $request->input('status');

        if($experience->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function storePersonal(Request $request)
    {

            $personal = new PersonalStyling;

            $occassion = $request->input('occassion');

            $multi_ocassion = implode(', ', array_map(function($entry) {
            return $entry['name'];
            }, $occassion));
            
            $personal->customer_id = $request->input('customer_id');

            $personal->service = $request->input('service');

            $personal->sex = $request->input('sex');

            $personal->occassion = $multi_ocassion;

            $personal->accessories = $request->input('accessories');

            $personal->fav_colors = $request->input('fav_colors');

            $personal->fav_brands = $request->input('fav_brands');

            $personal->budget = $request->input('budget');

            $personal->status = 'Pending';

            if ($personal->save()) {
                
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