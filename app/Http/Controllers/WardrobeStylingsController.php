<?php

namespace App\Http\Controllers;

use Session;
use App\WardrobeStyling;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WardrobeStylingsController extends Controller
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

        $wardrobe_stylings = DB::table('wardrobe_stylings')->leftJoin('customers','wardrobe_stylings.customer_id', '=',  'customers.customer_id')->select('customers.*',  'wardrobe_stylings.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_wardrobe_stylings')->with(['user'=> $user,'admins'=> $admins, 'wardrobe_stylings'=> $wardrobe_stylings]);

    }

    

    public function updateAdmin(Request $request)
    {
        $wardrobe_styling = WardrobeStyling::where('id', $request->input('id'))->first();

        $wardrobe_styling->in_charge = $request->input('in_charge');

        if($wardrobe_stylings->save()){
            Session::flash('success', $wardrobe_styling->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $wardrobe_styling = WardrobeStylings::where('id', $request->input('id'))->first();

        $wardrobe_styling->status = $request->input('status');

        if($wardrobe_styling->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function getWard()
    {
        # code...
    }

    
}
