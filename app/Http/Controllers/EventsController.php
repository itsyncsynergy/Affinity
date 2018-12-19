<?php

namespace App\Http\Controllers;

use Session;
use File;
use App\Event;
use App\Tags;
use App\TagItem;
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

        $events = Event::all();

        // $events = DB::table('events')->join('groups','groups.group_id','=','events.group_id')->select('groups.name as group_name', 'events.*')->orderBy('created_at', 'asc')->get()->toArray(); //Event::all();

        return view('admin_events')->with(['user'=> $user, 'events'=> $events]);
    }

    


    public function newEvent(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $groups = Group::all();

        $tags = Group::all();

        return view('admin_event_new')->with(['user'=> $user, 'groups'=> $groups, 'tags' => $tags]);
    }

    public function editEvent($id){

        $gallery = DB::table('event_gallery')->where('event_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $groups = Group::all();

        $tags = Group::all();

        $eventTag = DB::table('groups')
        ->join('tag_item', 'groups.group_id', '=', 'tag_item.tag_id')
        ->select('groups.group_id', 'groups.name')
        ->where('tag_item.postID', $id)
        ->get();

        $event =  Event::where('event_id', $id)->first();		
        
        return view('admin_event_edit')->with(['user'=> $user, 'gallery'=> $gallery, 'event'=> $event, 'groups'=> $groups, 'tags' => $tags, 'eventTag'=> $eventTag]);
    }

    public function viewEvent($id)
    {
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $gallery = DB::table('event_gallery')->where('event_id', $id)->get()->toArray();

        $members_joined = DB::table('customer_event')->where('event_id', $id)->join('customers','customers.customer_id','=','customer_event.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_event.*')->get()->toArray();


        return view('admin_events_view')->with(['user'=> $user, 'members_joined'=> $members_joined, 'gallery' => $gallery]);
    }

    public function addTag(Request $request)
    {
        $tags = $request->input('tag_id');

        $postID = $request->input('event_id');

        $postTypeID = 1;

        foreach ($tags as $tag) {
           
           $newItem = new TagItem;

           $newItem->tag_id = $tag;

           $newItem->postID = $postID;

           $newItem->postTypeID = $postTypeID;

           $newItem->save();

           
        }

        return back();

    }

    public function deleteTag($id, $event_id)
    {
        $tag = TagItem::where([

                    ['tag_id', '=', $id],
                    ['postID', '=', $event_id]
        ]);

        $tag->delete(); 

        return back();
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
        $tags = $request->input('tag_id');

        $postTypeID = 1; //ID given to events to be dropped in tags_item table for use in the api

        $event = new Event;

        $event->group_id = implode(",",$request->input('group_id'));

        $event->name = $request->input('name');

        $event->event_type = $request->input('event_type');

        $event->curr = $request->input('curr');

        $event->price = $request->input('price');

        $event->description = $request->input('description');

        $event->location = $request->input('location');

        $event->capacity = $request->input('capacity');

        $event->date = substr( $request->input('date'), 0,10 );

        $event->end_date = substr($request->input('date'), 13,21 + 1);

        $event->bgcolor = '#6A0608';

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');
        
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $event->avatar = $path;

        } 
        

        if($event->save()){

            $event_id = $event->event_id;

                foreach ($tags as $tag) {
                   
                    $taggedItem = new TagItem;

                    $taggedItem->tag_id = $tag;

                    $taggedItem->postID = $event_id;

                    $taggedItem->postTypeID = $postTypeID;

                    $taggedItem->save();

                    
                }

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

    public function delete($id)
    {
       $event = Event::where('event_id', $id)->first();

        if($event->delete()){
            Session::flash('success', 'Group '.  $event->name . ' has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function getPosts($id)
    {
       try {

            $event = Event::where('group_id', $id)->get();

            return response()->json(['error' => false, 'event' => $event],200);
           
       } 
       catch (ModelNotFoundException $ex) 
       {
           return response()->json(['error' => true, 'message' => 'Record not found'],404);
       }

    }
    public function getSingle($id)
    {
       $event = Event::where('event_id', $id)->first();

       $gallery = DB::table('event_gallery')
        ->select('avatar as images')
        ->where('event_id', $id)
        ->get();

       return response()->json([
                                'event' => $event,
                                'gallery' => $gallery,
                            ]);
    }

    public function showEvents()
    {
        try
        {
            // $event = Event::all();
            $event = DB::table('events')
            ->select('event_id as category_id', 'name as cate_title', 'avatar')
            ->get();

            return response()->json([
                'error' => false, 
                'event' => $event
            ],200);
        }
        catch (ModelNotFoundException $ex)
        {
            // Record not found... return error message
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }
    public function show($id)
    {
        //
        try
        {
            $event = Event::findOrFail($id);

            $gallery = EventGallery::where('event_id', $id)
            ->select('id', 'avatar as image')
            ->get();

            $gimage = EventGallery::where('event_id', $id)
            ->select('avatar as images')
            ->first();

            if ($gallery->isEmpty()) {
                
                    $gallery = null;       

            } 

            if ($gimage) {
                $gimage = $gimage->images;
            } else {
               $gimage = null;
            }
            

            return response()->json([
                'error' => false,
                'code' => 200,
                'event' => $event,
                'gimage' => $gimage,
                'gallery' => $gallery,
                
            ]);
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
    

        $event = Event::where('event_id', $request->input('event_id'))->first();

        $event->group_id = implode(",",$request->input('group_id'));

        $event->name = $request->input('name');

        $event->curr = $request->input('curr');

        $event->price = $request->input('price');

        $event->description = $request->input('description');

        $event->event_type = $request->input('event_type');

        $event->location = $request->input('location');

        $event->capacity = $request->input('capacity');

        $event->date = substr( $request->input('date'), 0,10 );

        $event->end_date = substr($request->input('date'), 13,21 + 1);

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
