<?php

namespace App\Http\Controllers;

use File;
use Session;
use App\Rental;
use App\RentalRequest;
use App\RentalGallery;
use App\Countries;
use App\States;
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

        $rentals = DB::table('rentals')
        ->join('countries', 'rentals.country', '=', 'countries.id')
        ->select('rentals.*', 'countries.name as countryName')
        ->orderBy('rentals.created_at', 'desc')
        ->get();

        return view('admin_rentals')->with(['user'=> $user, 'rentals'=> $rentals]);
    }

    public function newRentals(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        // $states = Countries::where('name', 'Nigeria')->select('name')->orderBy('name', 'asc')->distinct()->get();

        $countries = Countries::all();

        $categories = DB::table('rentals_categories')->get()->toArray();

        return view('admin_rental_new')->with(['user'=> $user, 'countries'=> $countries, 'categories' => $categories]);
    }

    public function getCategories()
    {
        $rental_categories = DB::table('rentals_categories')->get()->toArray();

        return $rental_categories;
    }

    public function getRentals($id)
    {
        $rentals = DB::table('rentals')
        ->join('rentals_categories', 'rentals.category', '=', 'rentals_categories.category_id')
        ->where('rentals.category', $id)
        ->select('rentals.id as category_id', 'rentals.name as cate_title','rentals.avatar', 'rentals.category','rentals.start_date', 'rentals.end_date', 'rentals.venue', 'rentals.state')
        ->get();

        return $rentals;
    }

    public function fetchItem($id)
    {
        // $item = Rental::where('id', $id)->first();

        $item = DB::table('rentals')
        ->join('countries', 'rentals.country', '=', 'countries.id')
        ->select('rentals.*', 'countries.name as country')
        ->where('rentals.id', $id)
        ->first();

        $gallery = RentalGallery::where('rental_id', $id)
        ->select('id', 'avatar as images')
        ->get();

        $gimage = RentalGallery::where('rental_id', $id)
        ->select('avatar as images')
        ->first();

        if ($gallery->isEmpty()) {

            $gallery = null;
            // $gimage = null;
        } 

        if ($gimage) {
            $gimage = $gimage->images;
        } else {
            $gimage = null;
        }
        
        

        return response()->json([
            'error' => false,
            'rental' => $item,
            'gimage' => $gimage,
            'gallery' => $gallery
        ]);
    }

    public function saveRequest(Request $request)
    {
        $category_id = $request->input('category_id');

        if ($category_id == 1){

             $booking = new RentalRequest;

             $booking->customer_id = $request->input('customer_id');

             $booking->category_id = $category_id;

             $booking->rental_id = $request->input('rental_id');

             $booking->check_in = $request->input('check_in');

             $booking->check_out = $request->input('check_out');

             $booking->no_of_pass = $request->input('no_of_guests');

             $booking->see_more = $request->input('see_more');

             $booking->additional_info = $request->input('additional');

             $booking->status = 'Pending';

             if ($booking->save()) {
            
                    return response()->json([
                        'error' => false,
                        'code' => 200,
                        'message' => 'Request Sent Successfully'
                    ]);

            } else {
                
                return response()->json([
                    'error' => true,
                    'code' => 201,
                    'message' => 'Request Not Sent'
                ]);

            }

        }elseif ($category_id == 2) {

            $date = implode(" ",$request->input('date'));

            $parts = explode(' ', $date);

            $start_date = $parts[0];

            $end_date = $parts[1];

            $booking = new RentalRequest;

             $booking->customer_id = $request->input('customer_id');

             $booking->category_id = $category_id;

             $booking->rental_id = $request->input('rental_id');

             $booking->duration = $request->input('duration');

             $booking->start_date = $start_date;

             $booking->end_date = $end_date;

             $booking->no_of_pass = $request->input('no_of_guests');

             $booking->see_more = $request->input('see_more');

             $booking->additional_info = $request->input('additional');

             $booking->status = 'Pending';

             if ($booking->save()) {
            
                    return response()->json([
                        'error' => false,
                        'code' => 200,
                        'message' => 'Request Sent Successfully'
                    ]);

            } else {
                
                return response()->json([
                    'error' => true,
                    'code' => 201,
                    'message' => 'Request Not Sent'
                ]);

            }


            
        }elseif ($category_id == 3) {
            
        }elseif ($category_id == 4) {

            $date = implode(" ",$request->input('date'));

            $parts = explode(' ', $date);

            $start_date = $parts[0];

            $end_date = $parts[1];

            $booking = new RentalRequest;

             $booking->customer_id = $request->input('customer_id');

             $booking->category_id = $category_id;

             $booking->rental_id = $request->input('rental_id');

             $booking->duration = $request->input('duration');

             $booking->start_date = $start_date;

             $booking->end_date = $end_date;

             $booking->no_of_pass = $request->input('no_of_guests');

             $booking->see_more = $request->input('see_more');

             $booking->additional_info = $request->input('additional');

             $booking->status = 'Pending';

             if ($booking->save()) {
            
                    return response()->json([
                        'error' => false,
                        'code' => 200,
                        'message' => 'Request Sent Successfully'
                    ]);

            } else {
                
                return response()->json([
                    'error' => true,
                    'code' => 201,
                    'message' => 'Request Not Sent'
                ]);

            }
           
        }
        


    }

    public function getState(Request $request){
    
        $states = States::where('country_id', $request->input('country_id'))->orderBy('id', 'asc')->get()->toArray();

        return response()->json(['error' => false, 'states' => $states],200);
    
    }

    public function getCode(Request $request){
    
        $codes = Countries::where('id', $request->input('country_id'))->get();

        $states = States::where('country_id', $request->input('country_id'))->orderBy('id', 'asc')->get()->toArray();

    return response()->json(['error' => false, 'codes' => $codes , 'states' => $states],200);
    
    }

    public function editRentals($id){

        $gallery = DB::table('rental_gallery')->where('rental_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $members_joined = DB::table('rental_requests')->where('rental_id', $id)->join('customers','customers.customer_id','=','rental_requests.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'rental_requests.*')->get()->toArray();
        // $countries = Location::distinct()->get(['country']);

        $countries = Countries::all();


        $categories = DB::table('rentals_categories')->get()->toArray();

        // $rental = Rental::where('id', $id)->first();

        $rental = DB::table('rentals')
        ->join('rentals_categories', 'rentals.category', '=', 'rentals_categories.category_id')
        ->join('countries', 'rentals.country', '=', 'countries.id')
        ->select('rentals.*', 'rentals_categories.cate_title as cate_title', 'rentals_categories.category_id as cate_id', 'countries.name as countryName', 'countries.id as countryID')
        ->where('rentals.id', $id)
        ->first();
		
        
        return view('admin_rental_edit')->with(['user'=> $user, 'members_joined'=> $members_joined,'gallery'=> $gallery, 'countries'=> $countries, 'rental'=> $rental, 'categories' => $categories]);
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

        $experience->curr = $request->input('curr');

        $experience->validity = $request->input('validity');

        $experience->price = $request->input('price');

        $experience->details = $request->input('details');

        $experience->ntk = $request->input('ntk');

        $experience->country = $request->input('country');

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        $experience->start_date = substr( $request->input('date'), 0,10 );

        $experience->end_date = substr($request->input('date'), 13,21 + 1);

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

        $experience->curr = $request->input('curr');

        $experience->validity = $request->input('validity');

        $experience->price = $request->input('price');

        $experience->details = $request->input('details');

        $experience->ntk = $request->input('ntk');

        $experience->country = $request->input('country');

        $experience->state = $request->input('state');
        
        $experience->venue = $request->input('venue');

        $experience->start_date = substr( $request->input('date'), 0,10 );

        $experience->end_date = substr($request->input('date'), 13,21 + 1);

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

    public function delete(Request $request)
    {
       $experience = Rental::where('id', $request->input('rental_id'))->first();

        if($experience->delete()){
            Session::flash('success', 'Record has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
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
