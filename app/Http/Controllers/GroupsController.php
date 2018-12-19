<?php

namespace App\Http\Controllers;

use Session;
use File;
use App\Group;
use App\Event;
use App\Subscription;
use App\GroupPost;
use App\GroupGallery;
use App\CustomerGroup;
use App\AppNotifications;
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

        $groups = DB::table('groups')
        ->join('admins','admins.admin_id','=','groups.group_head_id')
        ->select('admins.name as admin_name', 'groups.*')
        ->orderBy('created_at', 'asc')
        ->get()
        ->toArray();
		
        
        return view('admin_groups')->with(['user'=> $user, 'groups'=> $groups]);

    }

    public function getInterest()
    {
        $groups = DB::table('groups')
        ->select('group_id','name', 'avatar')
        ->get();

        return $groups;
    }

    public function myInterest($id)
    {
        $myInterest = DB::table('customer_group')
        ->leftjoin('groups','customer_group.group_id','=','groups.group_id')
        ->select('groups.name', 'customer_group.customer_id')
        ->where('customer_group.customer_id', $id)
        ->get();

        $today = Carbon::now();
        
        $sub = Subscription::where('customer_id', $id)->first();
        if ($sub) {
                if ($today <= $sub->end_date ) {

                $date = date_create($sub->end_date);

                $new = date_format($date, "F d, Y");

                return response()->json([
                'error' => false,
                'customer_interest' => $myInterest,
                'subscription_details' => $sub,
                'message' => 'Your Subscription will Expire on'.' '. $new,
                ]);
                } 
                else {

                    $date = date_create($sub->end_date);

                    $new = date_format($date, "F d, Y");

                    return response()->json([
                    'error' => false,
                    'customer_interest' => $myInterest,
                    'subscription_details' => $sub,
                    'message' => 'Your Subscription expired on '.' '. $new,
                    ]);
                }

        } else {

            return response()->json([
            'error' => false,
            'customer_interest' => $myInterest,
            'message' => 'No Subscription',

            ]);
        }
    
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

    public function viewGroup($id)
    {
       $user = Auth::user();
       $user = Admin::where('admin_id', $user->details_id)->first();

       $gallery = DB::table('group_gallery')->where('group_id', $id)->get()->toArray();

       $members_joined = DB::table('customer_group')->where('group_id', $id)->join('customers','customers.customer_id','=','customer_group.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_group.*')->get()->toArray();

        $group = DB::table('groups')->where('group_id', $id)->join('admins','admins.admin_id','=','groups.group_head_id')->select('admins.name as admin_name', 'groups.*')->first();
        
        $group_posts =  DB::table('group_posts')->where('group_posts.group_id', $id)->join('groups','groups.group_id','=','group_posts.group_id')->select('group_posts.*', 'groups.avatar as group_avatar', 'groups.name as group_name')->get()->toArray();

        $events = DB::table('events')->where('group_id', $id)->get()->toArray();

        $admins = Admin::all();

       return view('admin_group_view')->with(['user'=> $user, 'group_posts'=>$group_posts, 'events'=> $events, 'members_joined'=> $members_joined, 'admins'=> $admins, 'group'=> $group, 'gallery'=> $gallery]);
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

    public function delete($id)
    {
        $group = Group::where('group_id', $id)->first();

        if($group->delete()){
            Session::flash('success', 'Group '.  $group->name . ' has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
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

    public function get_details_group($id, $customer_id)
    {
        $group = Group::where('group_id', $id)->first();

        $gallery = GroupGallery::where('group_id', $id)
        ->select('id', 'avatar as image')
        ->get();

        $group_posts = GroupPost::where('group_id', $id)
        ->get();

        $group_events = Event::where('group_id', $id)
        ->select('date as start', 'end_date as end', 'name as text', 'bgcolor as background')
        ->get();

        $members = DB::table('customer_group')
        ->select('customer_group.*')
        ->where([ ['group_id', $id],
            ['customer_id', $customer_id],
        ])
        ->first();

        if ($members) {

            $status = $members->status;
        }elseif (!$members) {
            $status = 0;
        }

        if ($gallery->isEmpty()){

            $gallery = null;
        }

        if ($group_posts->isEmpty()) {

            $group_posts = null;
        } 
        
        if ($group_events->isEmpty()) {

            $group_events = null;
        } 

        return response()->json([
            'error' => false,
            'group' => $group,
            'gallery' => $gallery,
            'posts' => $group_posts,
            'activities' => $group_events,
            'status' => $status
         ]);
    }

    public function be_a_member($id, $customer_id)
    {
        $new_member = new CustomerGroup;

        $new_member->customer_id = $customer_id;

        $new_member->group_id = $id;

        $new_member->status = 1;

        if ($new_member->save()) {

            $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

            return response()->json([
                'error' => false,
                'message' => 'You are now a member',
                'status' => $new_member->status,
                'interest' => $userInterest
            ]);

        } else {

            $status = 0;

            $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

            return response()->json([
                'error' => true,
                'message' => 'Ooops!!! We cant add you to the group at the moment',
                'status' => $status,
                'interest' => $userInterest
            ]);

        }
        
    }

    public function leave_a_group($id, $customer_id)
    {
        $member_out = DB::table('customer_group')
            ->where([
                ['customer_id', '=', $customer_id],
                ['group_id', '=', $id],
            ]);
            $get_group_name = Group::where('group_id', $id)->first();

            $name = $get_group_name->name;

            $delete = $member_out->first();

            if ($member_out->delete()) {

                $notification = new AppNotifications;

                $notification->customer_id = $customer_id;

                $notification->message = 'We noticed you left the '. $name.' Interest Group and we would like to know why. Kindly send us an email at info@theaffinityclub.com to help us improve our services. Thank you.';

                $notification->status = 1;

                $notification->save();

                $status = 0;

                $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

                return response()->json([
                    'error' => false,
                    'message' => 'You are no longer a participant',
                    'status' => $status,
                    'interest' => $userInterest

                ]);

            } else {
                 $status = 0;

                 $userInterest = DB::table('customer_group')
                ->join('groups', 'groups.group_id', '=', 'customer_group.group_id')
                ->select('customer_group.group_id', 'groups.name', 'groups.avatar')
                ->where('customer_group.customer_id', $customer_id)
                ->get();

                return response()->json([

                    'error' => true,
                    'message' => 'You are not a member',
                    'status' => $status,
                    'interest' => $userInterest
                ]);

            }
            
    }
}
