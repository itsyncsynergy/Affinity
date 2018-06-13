<?php

namespace App\Http\Controllers;

use Session;
use App\Feed;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedsController extends Controller
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

        $feeds = Feed::all();
        
        return view('admin_feeds')->with(['user'=> $user, 'feeds'=> $feeds]);

    }

   
    public function store(Request $request)
    {
        $feed = new Feed;

        $feed->title = $request->input('title');

        $feed->post = $request->input('post');

        $feed->feed_type = $request->input('feed_type'); 

        $avatar = $request->file('avatar'); 
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $feed->avatar = $path;
        


        if($feed->save()){
            Session::flash('success', 'Group '. $feed->title . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create group');
            return back();
        }  

    }

    
    


    public function deleteFile(Request $request)
    {
        File::delete($request->input('avatar'));

        $gallery = GroupGallery::where('group_id', $id)->first();

        $gallery->group_id = $request->input('group_id');


        if($gallery->delete()){
            Session::flash('success', 'Image has been deleted');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not delete image');
            return back();
        }  
    }    

    public function update(Request $request)
    {
        $feed = Feed::where('id', $request->input('feed_id'))->first();

        $feed->title = $request->input('title');

        $feed->post = $request->input('post');

        $feed->feed_type = $request->input('feed_type'); 

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $feed->avatar = $path;
        }


        if($feed->save()){
            Session::flash('success',$feed->title . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated feed');
            return back();
        }  

    }


    

    public function destroy($id)
    {
        //
        try
        {

            $group = Group::findOrFail($id);


            if ($group->delete())
            {

            return response()->json(['error' => false, 'message' => 'Group record deleted successfully'],200);
            
            }

            return response()->json(['error' => true, 'message' => 'Group record could not be deleted'],200);
        
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }


     /**
     * Function to fetch group customers
     *
     * @param  int  $group_id
     * @return \Illuminate\Http\Response
     */
    public function getCustomers($group_id)
    {
        //
        try
        {

            $group = Group::findOrFail($group_id);

            $customers = $group->customers()->get()->toArray();

            return response()->json(['error' => false, 'customers' => $customers], 200);

        }
        catch (ModelNotFoundException $ex)
        {

            return response()->json(['error' => true, 'message' => 'Record not found'], 404);

        }      
    }

    /**
     * Function to fetch group events
     *
     * @param  int  $group_id
     * @return \Illuminate\Http\Response
     */
    public function getEvents($group_id)
    {
        //
        try
        {

            $group = Group::findOrFail($group_id);

            $events = $group->events()->get()->toArray();

            return response()->json(['error' => false, 'events' => $events], 200);

        }
        catch (ModelNotFoundException $ex)
        {

            return response()->json(['error' => true, 'message' => 'Record not found'], 404);

        }       
    }
}
