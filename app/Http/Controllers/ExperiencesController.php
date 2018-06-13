<?php

namespace App\Http\Controllers;

use Session;
use File;
use App\Experience;
use App\ExperienceGallery;
use App\Location;
use App\Merchant;
use App\Admin;
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

        $experiences = DB::table('experiences')->orderBy('created_at', 'desc')->get();

        return view('admin_experiences')->with(['user'=> $user, 'experiences'=> $experiences]);
    }

    public function newExperiences(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $countries = Location::distinct()->get(['country']);

        return view('admin_experience_new')->with(['user'=> $user, 'countries'=> $countries]);
    }

    public function editExperiences($id){

        $gallery = DB::table('experience_gallery')->where('experience_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $members_joined = DB::table('customer_experiences')->where('experience_id', $id)->join('customers','customers.customer_id','=','customer_experiences.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_experiences.*')->get()->toArray();
        $countries = Location::distinct()->get(['country']);
        $experience = Experience::where('experience_id', $id)->first();
		
        
        return view('admin_experience_edit')->with(['user'=> $user, 'members_joined'=> $members_joined,'gallery'=> $gallery, 'countries'=> $countries, 'experience'=> $experience]);
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
        $experience = new Experience;

        $experience->experience_name = $request->input('experience_name');

        $experience->price = $request->input('price');

        $experience->overview = $request->input('overview');

        $experience->details = $request->input('details');

        $experience->ntk = $request->input('ntk');

        $experience->country = 'Nigeria';

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        

        $experience->experience_start_date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $experience->experience_end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $experience->avatar = $path;
        


        if($experience->save()){
            Session::flash('success', 'Event '. $experience->experience_name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create experience');
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

        $experience->price = $request->input('price');

        $experience->overview = $request->input('overview');

        $experience->details = $request->input('details');

        $experience->ntk = $request->input('ntk');

        $experience->country = 'Nigeria';

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        

        $experience->experience_start_date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $experience->experience_end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);

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
