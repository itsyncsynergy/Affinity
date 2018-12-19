<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\Volunteer;
use App\VolunteerCategories;
use App\Location;
use App\Countries;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteersController extends Controller
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
        $categories = VolunteerCategories::all();
        // $volunteers = Volunteer::all();
        // $countries = Location::distinct()->get(['country']);

        $countries = Countries::all();

        $results = DB::table('volunteers')
        ->join('volunteer_categories', 'volunteers.category_id', '=', 'volunteer_categories.category_id')
        ->select('volunteers.*', 'volunteer_categories.cate_title')
        ->get();

        return view('admin_volunteers')->with(['user'=> $user, 'results'=> $results, 'countries'=>$countries, 'categories'=>$categories]);

    }

    public function getVolunteers($id)
    {
        $volunteer = DB::table('volunteers')
        ->join('volunteer_categories', 'volunteers.category_id', '=', 'volunteer_categories.category_id')
        ->select('volunteers.id as category_id', 'volunteers.title as cate_title', 'avatar')
        ->where('volunteers.category_id', $id)
        ->get();

        return response()->json(['error' => false, 'volunteer' => $volunteer], 200);

    }

    public function fetchVolunteer($id)
    {
        $volunteer = Volunteer::where('id', $id)->first();

        return $volunteer;
    }

   
    public function store(Request $request)
    {
        $volunteer= new Volunteer;

        $volunteer->title = $request->input('title');

        $volunteer->post = $request->input('post');

        $volunteer->state = $request->input('state'); 

        $volunteer->country = $request->input('country'); 

        $volunteer->ntk = $request->input('ntk'); 

        $volunteer->category_id = $request->input('category_id');

        $volunteer->fee = $request->input('fee');

        $volunteer->price = $request->input('price');

        $volunteer->itinerary = $request->input('itinerary');

        $volunteer->start_date = substr( $request->input('date'), 0,10 );

        $volunteer->end_date = substr($request->input('date'), 13,21 + 1);


        $avatar = $request->file('avatar'); 
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $volunteer->avatar = $path;
        


        if($volunteer->save()){
            Session::flash('success', $volunteer->type . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Process execution failed');
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
        $volunteer = Volunteer::where('id', $request->input('volunteer_id'))->first();

        $volunteer->title = $request->input('title');

        $volunteer->post = $request->input('post');

        $volunteer->state = $request->input('state'); 

        $volunteer->country = $request->input('country'); 

        $volunteer->ntk = $request->input('ntk'); 

        $volunteer->category_id = $request->input('category_id');

        $volunteer->fee = $request->input('fee');

        $volunteer->price = $request->input('price');

        $volunteer->itinerary = $request->input('itinerary');

        $volunteer->start_date = substr( $request->input('date'), 0,10 );

        $volunteer->end_date = substr($request->input('date'), 13,21 + 1);


        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $volunteer->avatar = $path;
        }


        if($volunteer->save()){
            Session::flash('success',$volunteer->title . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        }  

    }

    public function delete(Request $request)
    {
        $volunteer = Volunteer::where('id', $request->input('volunteer_id'))->first();

        if($volunteer->delete()){
            Session::flash('success', 'Volunteers has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
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
