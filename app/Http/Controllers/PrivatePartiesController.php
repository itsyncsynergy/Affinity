<?php

namespace App\Http\Controllers;

use Session;
use App\PrivateParty;
use App\PrivatepartyInfoRequest;
use App\Location;
use App\PrivatePartyGallery;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivatePartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $events = PrivateParty::all();

        return view('admin_private_parties')->with(['user'=> $user, 'events'=> $events]);

    }


    public function newPrivateParty(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $countries = Location::distinct()->get(['country']);
        return view('admin_private_party_new')->with(['user'=> $user, 'countries'=> $countries]);
    }

    public function editPrivateParty($id){

        $gallery = DB::table('private_party_galleries')->where('private_party_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $countries = Location::distinct()->get(['country']);
        $members_joined = DB::table('privateparty_info_requests')->where('private_party_id', $id)->join('customers','customers.customer_id','=','privateparty_info_requests.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'privateparty_info_requests.*')->get()->toArray();

        $event = DB::table('private_parties')->where('id', $id)->first();
		
        
        return view('admin_private_party_edit')->with(['user'=> $user, 'members_joined'=> $members_joined, 'gallery'=> $gallery, 'event'=> $event,'countries'=> $countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $event = new PrivateParty;

        $event->title = $request->input('title');

        $event->city = $request->input('city');

        $event->state = $request->input('state');

        $event->country = $request->input('country');

        $event->details = $request->input('details');

        $event->capacity = $request->input('capacity');

        $event->date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $event->end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);


        //$event->time = $request->input('time');

        //$event->created_by = $request->input('created_by');

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $event->avatar = $path;
        


        if($event->save()){
            Session::flash('success', 'Event '. $event->name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create event');
            return back();
        }  

    }
    public function upload(Request $request)
    {
        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));

        $gallery = new PrivatePartyGallery;

        $gallery->private_party_id = $request->input('event_id');
        
        $gallery->image = $path;
        


        if($gallery->save()){
            Session::flash('success', 'Image has been uploaded');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not upload image');
            return back();
        }  
    }    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        try
        {
            
            $event = Event::findOrFail($id);

            return response()->json(['error' => false, 'event' => $event],200);

        }
        catch (ModelNotFoundException $ex)
        {
            // Record not found... return error message
            return response()->json(['error' => true, 'message' => 'Record not found'],404);

        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $event = PrivateParty::where('id', $request->input('id'))->first();

        $event->title = $request->input('title');

        $event->city = $request->input('city');

        $event->state = $request->input('state');

        $event->country = $request->input('country');

        $event->details = $request->input('details');

        $event->capacity = $request->input('capacity');

        $event->date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $event->end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);


        //$event->time = $request->input('time');

        //$event->created_by = $request->input('created_by');
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $event->avatar = $path;
        }


        if($event->save()){
            Session::flash('success', 'Event '. $event->name . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create event');
            return back();
        }  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try
        {

            $event = Event::findOrFail($id);


            if ($event->delete())
            {

                return response()->json(['error' => false, 'message' => 'Event record deleted successfully'],200);
            
            }

            return response()->json(['error' => true, 'message' => 'Event record could not be deleted'],200);
        
        }
        catch (ModelNotFoundException $ex)
        {

            return response()->json(['error' => true, 'message' => 'Record not found'],404);

        }
    }

    public function requests()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $events = DB::table('privateparty_info_requests')->leftJoin('customers','privateparty_info_requests.customer_id', '=',  'customers.customer_id')->join('private_parties','private_parties.id', '=',  'privateparty_info_requests.private_party_id')->select('customers.*',  'privateparty_info_requests.*', 'privateparty_info_requests.id as event_id', 'private_parties.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_private_parties_requests')->with(['user'=> $user,'admins'=> $admins, 'events'=> $events]);

    }

    

    public function updateAdmin(Request $request)
    {
        $event = PrivatepartyInfoRequest::where('id', $request->input('id'))->first();

        $event->in_charge = $request->input('in_charge');

        if($event->save()){
            Session::flash('success', $event->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $event = PrivatepartyInfoRequest::where('id', $request->input('id'))->first();

        $event->status = $request->input('status');

        if($event->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }
}
