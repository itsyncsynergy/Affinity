<?php

namespace App\Http\Controllers;

use File;
use Session;
use App\Rental;
use App\RentalRequest;
use App\RentalGallery;
use App\Location;
use App\Merchant;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RentalsController extends Controller
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

        $rentals = DB::table('rentals')->orderBy('created_at', 'desc')->get();

        return view('admin_rentals')->with(['user'=> $user, 'rentals'=> $rentals]);
    }

    public function newRentals(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $states = Location::where('country', 'Nigeria')->select('state')->orderBy('state', 'asc')->distinct()->get();

        $countries = Location::distinct()->get(['country']);

        return view('admin_rental_new')->with(['user'=> $user, 'countries'=> $countries]);
    }

    public function editRentals($id){

        $gallery = DB::table('rental_gallery')->where('rental_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $members_joined = DB::table('rental_requests')->where('rental_id', $id)->join('customers','customers.customer_id','=','rental_requests.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'rental_requests.*')->get()->toArray();
        $countries = Location::distinct()->get(['country']);

        $rental = Rental::where('id', $id)->first();
		
        
        return view('admin_rental_edit')->with(['user'=> $user, 'members_joined'=> $members_joined,'gallery'=> $gallery, 'countries'=> $countries, 'rental'=> $rental]);
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
        $experience = new Rental;

        $experience->name = $request->input('name');

        $experience->category = $request->input('category');

        $experience->price = $request->input('price');

        $experience->overview = $request->input('overview');

        $experience->details = $request->input('details');

        $experience->ntk = $request->input('ntk');

        $experience->country = $request->input('country');

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        

        $experience->start_date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $experience->end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);

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

    public function deleteImage($id)
    {
    
        $rental = RentalGallery::where('id', $id)->first();

        $rental->delete();

        File::delete(public_path().'/images'.$rental->avatar);

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
            $offer = MerchantOffer::findOrFail($id);

            return response()->json(['error' => false, 'offer' => $offer],200);

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
    public function update(Request $request)
    {
        //
        $experience = Rental::where('id', $request->input('rental_id'))->first();

        $experience->name = $request->input('name');

        $experience->category = $request->input('category');

        $experience->price = $request->input('price');

        $experience->overview = $request->input('overview');

        $experience->details = $request->input('details');

        $experience->ntk = $request->input('ntk');

        $experience->country = $request->input('country');

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        

        $experience->start_date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $experience->end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);

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

        $gallery = new RentalGallery;

        $gallery->rental_id = $request->input('rental_id');
        
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

    public function requests()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $requests = DB::table('rental_requests')->leftJoin('customers','rental_requests.customer_id', '=',  'customers.customer_id')->join('rentals','rentals.id', '=',  'rental_requests.rental_id')->select('customers.*',  'rental_requests.*', 'rentals.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_rental_requests')->with(['user'=> $user,'admins'=> $admins, 'requests'=> $requests]);

    }

    

    public function updateAdmin(Request $request)
    {
        $luxury = RentalRequest::where('id', $request->input('id'))->first();

        $luxury->in_charge = $request->input('in_charge');

        if($luxury->save()){
            Session::flash('success', $luxury->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $luxury = RentalRequest::where('id', $request->input('id'))->first();

        $luxury->status = $request->input('status');

        if($luxury->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }
}
