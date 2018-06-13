<?php

namespace App\Http\Controllers;

use Session;
use File;
use App\Event;
use App\EventGallery;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
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

        $events = DB::table('events')->join('groups','groups.group_id','=','events.group_id')->select('groups.name as group_name', 'events.*')->orderBy('created_at', 'desc')->get()->toArray(); //Event::all();

        return view('admin_events')->with(['user'=> $user, 'events'=> $events]);
    }


    public function newEvent(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $groups = Group::all();

        return view('admin_event_new')->with(['user'=> $user, 'groups'=> $groups]);
    }

    public function editEvent($id){

        $gallery = DB::table('event_gallery')->where('event_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $members_joined = DB::table('customer_event')->where('event_id', $id)->join('customers','customers.customer_id','=','customer_event.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_event.*')->get()->toArray();

        $groups = Group::all();
        $event = DB::table('events')->where('event_id', $id)->join('groups','events.group_id','=','groups.group_id')->select('groups.name as group_name', 'events.*')->first();
		
        
        return view('admin_event_edit')->with(['user'=> $user, 'members_joined'=> $members_joined, 'gallery'=> $gallery, 'event'=> $event, 'groups'=> $groups]);
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
        $event = new Event;

        $event->group_id = $request->input('group_id');

        $event->name = $request->input('name');

        $event->event_type = $request->input('event_type');

        $event->description = $request->input('description');

        $event->location = $request->input('location');

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

        $gallery = new EventGallery;

        $gallery->event_id = $request->input('event_id');
        
        $gallery->avatar = $path;
        


        if($gallery->save()){
            Session::flash('success', 'Image has been uploaded');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not upload image');
            return back();
        }  
    }    

    public function deleteImage($id)
    {
    
        $event = EventGallery::where('id', $id)->first();

        $event->delete();

        File::delete(public_path().'/images'.$event->avatar);

        Session::flash('success', 'Image has been successfully deleted');
            return back();
    
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
        $event = Event::where('event_id', $request->input('event_id'))->first();

        $event->group_id = $request->input('group_id');

        $event->name = $request->input('name');

        $event->description = $request->input('description');

        $event->event_type = $request->input('event_type');

        $event->location = $request->input('location');

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

     /**
     * Function to fetch event customers
     *
     * @param  varchar  $event_id
     * @return \Illuminate\Http\Response
     */
    public function getCustomers($event_id)
    {
        //
        try
        {

            $event = Event::findOrFail($event_id);

            $customers = $event->customers()->get()->toArray();

            return response()->json(['error' => false, 'customers' => $customers], 200);

        }
        catch (ModelNotFoundException $ex)
        {

            return response()->json(['error' => true, 'message' => 'Record not found'], 404);

        }

    }
}
