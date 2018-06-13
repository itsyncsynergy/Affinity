<?php

namespace App\Http\Controllers;

use Session;
use File;
use App\Group;
use App\Event;
use App\GroupPost;
use App\GroupGallery;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupsController extends Controller
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

        $groups = DB::table('groups')->join('admins','admins.admin_id','=','groups.group_head_id')->select('admins.name as admin_name', 'groups.*')->orderBy('created_at', 'desc')->get()->toArray();
		
        //$groups = Group::all();
        
        return view('admin_groups')->with(['user'=> $user, 'groups'=> $groups]);

    }

    public function newGroup(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $admins = Admin::all();

        return view('admin_group_new')->with(['user'=> $user, 'admins'=> $admins]);
    }

    public function groupPosts($id){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $group_posts =  DB::table('group_posts')->where('group_posts.group_id', $id)->join('groups','groups.group_id','=','group_posts.group_id')->select('group_posts.*', 'groups.avatar as group_avatar', 'groups.name as group_name')->get()->toArray();
        
        return view('admin_group_posts')->with(['user'=> $user, 'id'=> $id, 'group_posts'=> $group_posts]);
    }

    public function editGroup($id){

        $gallery = DB::table('group_gallery')->where('group_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $members_joined = DB::table('customer_group')->where('group_id', $id)->join('customers','customers.customer_id','=','customer_group.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_group.*')->get()->toArray();

        $group = DB::table('groups')->where('group_id', $id)->join('admins','admins.admin_id','=','groups.group_head_id')->select('admins.name as admin_name', 'groups.*')->first();
        
        $group_posts =  DB::table('group_posts')->where('group_posts.group_id', $id)->join('groups','groups.group_id','=','group_posts.group_id')->select('group_posts.*', 'groups.avatar as group_avatar', 'groups.name as group_name')->get()->toArray();

        $admins = Admin::all();

        $events = DB::table('events')->where('group_id', $id)->get()->toArray();

        return view('admin_group_edit')->with(['user'=> $user, 'group_posts'=>$group_posts, 'events'=> $events, 'members_joined'=> $members_joined, 'gallery'=> $gallery, 'admins'=> $admins, 'group'=> $group]);
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
        $group = new Group;

        $group->name = $request->input('name');

        //$group->creator_id = $request->input('creator_id'); //confirm if user exists...

        $group->details = $request->input('details');

        $group->group_head_id = $request->input('group_head_id'); // not confirmed... maybe creator_id by default...

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $group->avatar = $path;
        


        if($group->save()){
            Session::flash('success', 'Group '. $group->name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create group');
            return back();
        }  

    }

    public function postStore(Request $request)
    {
        $group = new GroupPost;

        $group->title = $request->input('title');

        $group->group_id = $request->input('group_id');

        //$group->creator_id = $request->input('creator_id'); //confirm if user exists...

        $group->post = $request->input('post');

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $group->avatar = $path;
        


        if($group->save()){
            Session::flash('success', 'Post '. $group->name . ' has been added');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create post');
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

        $gallery = new GroupGallery;

        $gallery->group_id = $request->input('group_id');
        
        $gallery->avatar = $path;
        


        if($gallery->save()){
            Session::flash('success', 'Image has been uploaded');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not upload image');
            return back();
        }  
    }    



    public function update(Request $request)
    {
        $group = Group::where('group_id', $request->input('group_id'))->first();

        $group->name = $request->input('name');

        //$group->creator_id = $request->input('creator_id'); //confirm if user exists...

        $group->details = $request->input('details');

        $group->group_head_id = $request->input('group_head_id'); // not confirmed... maybe creator_id by default...

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); // create method to handle this section...
        
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $group->avatar = $path;
        }    
        


        if($group->save()){
            Session::flash('success', 'Group '. $group->name . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not update group');
            return back();
        }  

    }

    public function deleteImage($id)
    {
    
        $group = GroupGallery::where('id', $id)->first();

        $group->delete();

        File::delete(public_path().'/images'.$group->avatar);

        Session::flash('success', 'Image has been successfully deleted');
            return back();
    
    }

    /**
     * 
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
            $group = Group::findOrFail($id);

            return response()->json(['error' => false, 'group' => $group],200);

        }

        catch (ModelNotFoundException $ex)
        {
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
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $group = GroupPost::where('id', $id)->first();


            if ($group->delete())
            {

            return back();
            
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
