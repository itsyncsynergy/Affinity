<?php

namespace App\Http\Controllers;

use File;
use Session;
use App\User;
use App\Location;
use App\Merchant;
use App\MerchantOffer;
use App\MerchantGallery;
use App\MerchantCategory;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\DB;

class MerchantsController extends Controller
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

        $merchants = Merchant::orderBy('created_at', 'desc')->get();//Merchant::all();

        return view('admin_merchants')->with(['user'=> $user, 'merchants'=> $merchants]);
    }

    public function newMerchant(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $categories = MerchantCategory::orderBy('category_id', 'desc')->get();
        $states = Location::where('country', 'Nigeria')->select('state')->distinct()->get();
       
        $countries = Location::distinct()->get(['country']);

        return view('admin_merchant_new')->with(['user'=> $user, 'categories'=> $categories, 'countries'=> $countries]);
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
        $merchant = new Merchant;
        $user = new User;
        
        if($user->confirmUsername($request->input('email')) != null){
            Session::flash('error', 'An error occured. Email already exist');
            return back();
        }
        
        //$merchant->merchant_id = generateMerchantID();

        $merchant->merchant_id = $this->generatefakeID();

        $merchant->category_id = $request->input('category_id');

        $merchant->name = $request->input('name');

        $merchant->address = $request->input('address');

        $merchant->contact = $request->input('contact');

        $merchant->email = $request->input('email');

        $merchant->website = $request->input('website');

        $merchant->details = $request->input('details');
		
        $merchant->country = $request->input('country');
        
        $merchant->bio = $request->input('bio');

        $merchant->ntk = $request->input('ntk');
		
		$merchant->state = $request->input('state');
		
		$merchant->city = $request->input('city');
		
        $merchant->latitude = $request->input('latitude');
        
        $merchant->longitude = $request->input('longitude');

        //$merchant->avatar = $request->input('avatar'); // create a method to handle image upload...

        //$merchant->verification_pin = generateDefaultPin();
        $merchant->verification_pin = rand(1000,9999);

        $avatar = $request->file('avatar'); 

        $merchant->avatar = $request->input('avatar');

        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $merchant->avatar = $path;
        
        
        
        
        //return response()->json(['error' => true, 'message' => 'no image'],400);
        
    
            if ($merchant->save())
            {
    
                $merchant = Merchant::find($merchant->merchant_id);
                
                $name = strtoupper($merchant->name);
                
                $merchant->merchant_id = substr($name, 0, 3) .str_pad($merchant->id, 4, "0", STR_PAD_LEFT );   
    
                $merchant->save(); 
    
                // Create Login account
        
                $user->username = $request->input('username');
                $user->password = bcrypt('password');
                $user->group_id = 2; // 2 for merchant profile
                $user->details_id = $merchant->merchant_id; 
                $user->user_type = "merchant";
                 $user->save();
        
                 Session::flash('success', 'Merchant profile created');
                 return back();
            }
        
            Session::flash('error', 'An error occured. Unable to create new merchant');
            return back();

    }

    public function edit($id){

        $gallery = DB::table('merchant_gallery')->where('merchant_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $merchant = Merchant::where('id', $id)->first();
        $countries = Location::distinct()->get(['country']);
        $offers = DB::table('merchant_offers')->where('merchant_id', $merchant->merchant_id)->get()->toArray();
        $categories = MerchantCategory::orderBy('category_id', 'desc')->get();
        $states = Location::select('state')->distinct()->get();

        return view('admin_merchant_edit')->with(['user'=> $user, 'merchant'=> $merchant, 'countries'=> $countries, 'offers'=> $offers, 'gallery'=> $gallery, 'categories'=> $categories, 'states'=> $states]);
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
            $merchant = Merchant::findOrFail($id);
            $offers = $merchant->offers()->get()->toArray(); 
            return response()->json(['error' => false, 'merchant' => $merchant, 
                'offers' => $offers],200);
        }

        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function upload(Request $request)
    {
        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));

        $gallery = new MerchantGallery;

        $gallery->merchant_id = $request->input('merchant_id');
        
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
    
        $merchant = Merchant::where('merchant_id', $request->input('merchant_id'))->first();

        $merchant->category_id = $request->input('category_id');

        $merchant->name = $request->input('name');

        $merchant->address = $request->input('address');

        $merchant->contact = $request->input('contact');
        
        $merchant->email = $request->input('email');

        $merchant->website = $request->input('website');

        $merchant->details = $request->input('details');

        $merchant->country = $request->input('country');
        
        $merchant->bio = $request->input('bio');

        $merchant->ntk = $request->input('ntk');
		
		$merchant->state = $request->input('state');
		
		$merchant->city = $request->input('city');
		
        $merchant->latitude = $request->input('latitude');
        
        $merchant->longitude = $request->input('longitude');
          
        if($request->hasFile('avatar')){
           $avatar = $request->file('avatar'); 

            $merchant->avatar = $request->input('avatar');
    
            $extension = $avatar->extension();
    
            $filename = time();
    
            $path = 'images/'.$filename.'.'.$extension;
    
            move_uploaded_file($avatar, public_path($path));
            
            $merchant->avatar = $path;
        }    
        
        if ($merchant->save())
        {
        Session::flash('success', 'Merchant profile updated');
        return back();
        }else{
            Session::flash('error', 'Unable to update merchant profile');
            return back();
        }    

    }

    public function deleteImage($id)
    {
    
        $merchant = MerchantGallery::where('id', $id)->first();

        $merchant->delete();

        File::delete(public_path().'/images'.$merchant->avatar);

        Session::flash('success', 'Image has been successfully deleted');
            return back();
    
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

            $merchant = Merchant::findOrFail($id);


            if ($merchant->delete())
            {

                $user = User::findByDetailsId($id);

                $user->delete();

                return response()->json(['error' => false, 'message' => 'Merchant record deleted successfully'],200);
            
            }

            return response()->json(['error' => true, 'message' => 'Merchant record could not be deleted'],200);
        
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }

    /**
     * Function to fetch merchant transactions
     *
     * @param  varchar  $merchant_id
     * @return \Illuminate\Http\Response
     */
    public function getTransactions($merchant_id)
    {
        //
        try
        {

            $merchant = Merchant::findOrFail($merchant_id);

            $transactions = $merchant->transactions()->get()->toArray(); 

            return response()->json(['error' => false, 'transactions' => $transactions],200);

        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }       
    } 

    /**
     * Function to fetch merchant reviews
     *
     * @param  varchar  $merchant_id
     * @return \Illuminate\Http\Response
     */
    public function getReviews($merchant_id)
    {
        //
        try
        {

            //$merchant = Merchant::findOrFail($merchant_id);
            
            //$reviews = DB::table('reviews')->join('transactions', function ($join) {
            //$join->on('reviews.merchant_id','=','transactions.merchant_id')->where('reviews.merchant_id', '=', $merchant_id);})->get();
            
            $reviews = DB::table('transactions')->where('transactions.merchant_id', $merchant_id)->get();

            //$reviews = $merchant->reviews()->get()->toArray(); 

            return response()->json(['error' => false, 'reviews' => $reviews],200); 
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }         
    } 

    /**
     * Function to fetch merchant offers
     *
     * @param  varchar  $merchant_id
     * @return \Illuminate\Http\Response
     */
    public function getOffers($merchant_id)
    {
        //
        try
        {
            $merchant = Merchant::findOrFail($merchant_id);

            $offers = $merchant->offers()->get()->toArray(); 

            return response()->json(['error' => false, 'offers' => $offers],200); 
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }        
    } 

    /**
     * Function to generate default pin.
     *
     * @return 
     */
    function generateDefaultPin()
    {
     
        $generatedPin = 000000;

        return $generatedPin;

    }

    public function generateCustomerID($id)
    {
     
        $customIdentifier = new CustomIdentifier;

        $generatedID = $customIdentifier->generateCustomID($id, "Merchant");

        return $generatedID;

    }
    
     public function getRatings()
    {
/*        $events = DB::table('events')
                    ->leftJoin('customer_event','events.event_id','=','customer_event.event_id')

                    ->select('events.*','customer_event.customer_id')
                    ->where('customer_event.customer_id','=','cs1')
                    ->get()->toArray();*/

        $reviews = DB::table('merchants')->leftJoin('reviews','reviews.merchant_id','=','merchants.merchant_id')->get();

        return response()->json(['reviews'=> $reviews],200);
    }

    public function generatefakeID()
    {
     
        $fake = time();

        return $fake;
    }

}
