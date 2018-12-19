<?php

namespace App\Http\Controllers;

use Session;
use File;
use App\Experience;
use App\ExperienceCategories;
use App\ExperienceGallery;
use App\Countries;
use App\Tags;
use App\TagItem;
use App\Location;
use App\Merchant;
use App\Group;
use App\Admin;
use App\CustomerExperience;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExperiencesController extends Controller
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

        $experiences = DB::table('experiences')
        ->join('experience_categories', 'experiences.category_id', '=', 'experience_categories.category_id')
        ->select('experiences.*', 'experience_categories.cate_title')
        ->get();

        return view('admin_experiences')->with(['user'=> $user, 'experiences'=> $experiences]);
    }

    public function requests()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $experience = DB::table('customer_experiences')
        ->Join('customers','customer_experiences.customer_id', '=',  'customers.customer_id')
        ->Join('experiences', 'customer_experiences.experience_id', '=', 'experiences.experience_id')
        ->select('customers.*',  'customer_experiences.*', 'experiences.experience_name as name')
        ->get()
        ->toArray();
		
        $admins = Admin::all();
        
        return view('admin_experiences_requests')->with(['user'=> $user,'admins'=> $admins, 'experience'=> $experience]);

    }

    public function updateAdmin(Request $request)
    {
        $experience = CustomerExperience::where('id', $request->input('id'))->first();

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
        $experience = CustomerExperience::where('id', $request->input('id'))->first();

        $experience->status = $request->input('status');

        if($experience->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function newExperiences(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $countries = Countries::all();

        $tags = Group::all();

        $categories = ExperienceCategories::all();

        return view('admin_experience_new')->with(['user'=> $user, 'countries'=> $countries, 'categories' => $categories, 'tags' => $tags]);
    }

    public function editExperiences($id){

        $gallery = DB::table('experience_gallery')->where('experience_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $groups = Group::all();
        
        $members_joined = DB::table('customer_experiences')->where('experience_id', $id)->join('customers','customers.customer_id','=','customer_experiences.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_experiences.*')->get()->toArray();
        $countries = DB::table('countries')
        ->join('experiences', 'countries.id', '=', 'experiences.country')
        ->select('experiences.*', 'countries.name')
        ->where('experience_id', $id)
        ->get();

        $tags = Group::all();

        $eventTag = DB::table('groups')
        ->join('tag_item', 'groups.group_id', '=', 'tag_item.tag_id')
        ->select('groups.group_id', 'groups.name')
        ->where('tag_item.postID', $id)
        ->get();

        $experience = Experience::where('experience_id', $id)->first();
		
        
        return view('admin_experience_edit')->with(['user'=> $user, 'members_joined'=> $members_joined,'gallery'=> $gallery, 'countries'=> $countries, 'experience'=> $experience, 'groups' => $groups, 'tags'=> $tags, 'eventTag'=> $eventTag]);
    }


    public function viewExperiences($id){

        $gallery = DB::table('experience_gallery')->where('experience_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $members_joined = DB::table('customer_experiences')->where('experience_id', $id)->join('customers','customers.customer_id','=','customer_experiences.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_experiences.*')->get()->toArray();

        $experience = DB::table('countries')
        ->join('experiences', 'countries.id', '=', 'experiences.country')
        ->join('experience_categories', 'experiences.category_id', '=', 'experience_categories.category_id')
        ->select('experiences.*', 'countries.name as countryName', 'countries.id as countryID', 'experience_categories.cate_title', 'experience_categories.category_id')
        ->where('experience_id', $id)
        ->first();
        
        return view('admin_experience_view')->with(['user'=> $user, 'members_joined'=> $members_joined,'gallery'=> $gallery, 'experience'=> $experience]);
    }

    public function addTag(Request $request)
    {
        $tags = $request->input('tag_id');

        $postID = $request->input('experience_id');

        $postTypeID = 2;

        foreach ($tags as $tag) {
           
           $newItem = new TagItem;

           $newItem->tag_id = $tag;

           $newItem->postID = $postID;

           $newItem->postTypeID = $postTypeID;

           $newItem->save();
  
        }

        return back();

    }

    public function deleteTag($id, $experience_id)
    {
        $tag = TagItem::where([

                    ['tag_id', '=', $id],
                    ['postID', '=', $experience_id]
        ]);

        $tag->delete(); 

        return back();
    }

    public function getExpcategories()
    {
        try
        {
            $experiences = ExperienceCategories::all();

            return $experiences->toArray();

            // return response()->json(['error' => false, 'experiences' => $experiences],200);
        }
        catch (ModelNotFoundException $ex)
        {
            // Record not found... return error message
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }

    public function getExperiences($id)
    {
        try
        {
            // $experiences = Experience::where('category_id', $id)->get()->toArray();

            $experiences = DB::table('experiences')
            ->select('experience_id as category_id', 'experience_name as cate_title', 'avatar','venue', 'state')
            ->where('category_id', $id)
            ->get();

            return $experiences;

            // return response()->json(['error' => false, 'experiences' => $experiences],200);
        }
        catch (ModelNotFoundException $ex)
        {
            // Record not found... return error message
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }

    public function singleExp($id)
    {
        try
        {
            $experience = Experience::findOrFail($id);

            $gallery = ExperienceGallery::where('experience_id', $id)
            ->select('id', 'avatar as image')
            ->get();

            $gimage = ExperienceGallery::where('experience_id', $id)
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
                'experience' => $experience,
                'gimage' => $gimage,
                'gallery' => $gallery,
                
            ]);

            // return response()->json(['error' => false, 'experience' => $experience],200);
        }
        catch (ModelNotFoundException $ex)
        {
            // Record not found... return error message
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
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

        $postTypeID = 2; //ID given to events to be dropped in tags_item table for use in the api

        $experience = new Experience;

        $experience->experience_name = $request->input('experience_name');

        $experience->price = $request->input('price');

        $experience->curr = $request->input('curr');

        $experience->category_id = $request->input('category_id');

        $experience->details = $request->input('details');

        $experience->country = $request->input('country');

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        $experience->experience_start_date = substr( $request->input('date'), 0,10 );

        $experience->experience_end_date = substr($request->input('date'), 13,21 + 1);

        if ($request->hasFile('avatar')) {
            
            $avatar = $request->file('avatar'); // create method to handle this section...
        
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $experience->avatar = $path;

        } 
        
        


        if($experience->save()){

            $experience_id = $experience->experience_id;

                foreach ($tags as $tag) {
                   
                    $taggedItem = new TagItem;

                    $taggedItem->tag_id = $tag;

                    $taggedItem->postID = $experience_id;

                    $taggedItem->postTypeID = $postTypeID;

                    $taggedItem->save();

                    
                }


            Session::flash('success', 'Event '. $experience->experience_name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create experience');
            return back();
        }  
    }

    public function delete($id)
    {
       $experience = Experience::where('experience_id', $id)->first();

        if($experience->delete()){
            Session::flash('success', 'Group '.  $experience->name . ' has been Deleted Successfully');
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
    public function show($id)
    {
        //
        try
        {
            $offer = MerchantOffer::findOrFail($id);

            return response()->json(['error' => false, 'offer' => $offer],200);

        }

        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }

    }

    public function deleteImage($id)
    {
    
        $experience = ExperienceGallery::where('id', $id)->first();

        $experience->delete();

        File::delete(public_path().'/images'.$experience->avatar);

        Session::flash('success', 'Image has been successfully deleted');
            return back();
    
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
        $experience = Experience::where('experience_id', $request->input('experience_id'))->first();

        $experience->experience_name = $request->input('experience_name');

        // $experience->group_id = implode(",",$request->input('group_id'));

        $experience->price = $request->input('price');

        // $experience->overview = $request->input('overview');

        $experience->details = $request->input('details');

        // $experience->ntk = $request->input('ntk');

        $experience->country = 'Nigeria';

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        

        $experience->experience_start_date = substr( $request->input('date'), 0,10 );

        $experience->experience_end_date = substr($request->input('date'), 13,21 + 1);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $experience->avatar = $path;
        }

        if($experience->save()){
            Session::flash('success', 'Event '. $experience->experience_name . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not update experience');
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

        $gallery = new ExperienceGallery;

        $gallery->experience_id = $request->input('experience_id');
        
        $gallery->avatar = $path;
        


        if($gallery->save()){
            Session::flash('success', 'Image has been uploaded');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not upload image');
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

            $experience = Experience::findOrFail($id);


            if ($experience->delete())
            {

            return response()->json(['error' => false, 'message' => 'Offer record deleted successfully'],200);
            
            }

            return response()->json(['error' => true, 'message' => 'Offer record could not be deleted'],200);
        
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }
}
