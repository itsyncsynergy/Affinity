<?php

namespace App\Http\Controllers;

use App\User;
use App\Merchant;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\DB;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $merchants = Merchant::orderBy('created_at', 'desc')->get();//Merchant::all();

        return response()->json(['error' => false, 'merchants' => $merchants],200);
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
        
        if($user->confirmUsername($request->input('username')) != null){
            return response()->json(['error' => true, 'message' => "Username has been taken, please choose a different one."],400);
        }
        
        //$merchant->merchant_id = generateMerchantID();

        $merchant->merchant_id = $this->generatefakeID();

        $merchant->category_id = $request->input('category_id');

        $merchant->name = $request->input('name');

        $merchant->address = $request->input('address');

        $merchant->contact = $request->input('contact');

        $merchant->email = $request->input('email');
		
		$merchant->country = $request->input('country');
		
		$merchant->state = $request->input('state');
		
		$merchant->city = $request->input('city');
		
        $merchant->latitude = $request->input('latitude');
        
        $merchant->longitude = $request->input('longitude');

        //$merchant->avatar = $request->input('avatar'); // create a method to handle image upload...

        //$merchant->verification_pin = generateDefaultPin();
        $merchant->verification_pin = $request->input('verification_pin');

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        if($request->has('avatar')){
            $merchant->avatar = $request->input('avatar');
            
        }
        
        
        //return response()->json(['error' => true, 'message' => 'no image'],400);
        
    
            if ($merchant->save())
            {
    
                $merchant = Merchant::find($merchant->merchant_id);
                
                $name = strtoupper($merchant->name);
                
                $merchant->merchant_id = substr($name, 0, 3) .str_pad($merchant->id, 4, "0", STR_PAD_LEFT );   
    
                $merchant->save(); 
    
                // Create Login account
        
                $user->username = $request->input('username');
                $user->password = bcrypt($request->input('password'));
                $user->group_id = 2; // 2 for merchant profile
                $user->details_id = $merchant->merchant_id; 
                $user->user_type = "merchant";
                 $user->save();
        
                return response()->json(['error' => false, 'message' => 'Record added successfully with ID: '. $merchant->merchant_id],200);
            }
        
        return response()->json(['error' => true, 'message' => 'Error. Refresh the page and ensure no field is empty'],400);

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
    public function update(Request $request, $id)
    {
        //
        try
        {

            $merchant = Merchant::findOrFail($id);

            if ($request->has('category_id'))
                $merchant->category_id = $request->input('category_id');

            if ($request->has('name'))
                $merchant->name = $request->input('name');

            if ($request->has('address'))
                $merchant->address = $request->input('address');

            if ($request->has('contact'))
                $merchant->contact = $request->input('contact');

            if ($request->has('email'))
                $merchant->email = $request->input('email');
			
			if ($request->has('city'))
                $merchant->email = $request->input('city');
			
			if ($request->has('state'))
                $merchant->email = $request->input('state');
			
			if ($request->has('address'))
                $merchant->address = $request->input('address');

            if ($request->has('longlat'))
                $merchant->longlat = $request->input('longlat');

            if ($request->has('verification_pin'))
                $merchant->verification_pin = $request->input('verification_pin');
            
            if ($request->has('latitude'))
                $merchant->latitude = $request->input('latitude');
            
            if ($request->has('longitude'))
                $merchant->longitude = $request->input('longitude');    

            $avatar = $request->file('avatar'); // create method to handle this section...
        
        if($request->has('avatar')){
            $merchant->avatar = $request->input('avatar');
        }else if ($request->hasFile('avatar')){
            //return response()->json(['error' => true, 'message' => 'there is image'],200);
            $extension = $avatar->extension();
            
           // $timestamp = Carbon::now();
             $timestamp = time();
    
            $filename = 'MRC_' . $timestamp . '.' . $extension; 
    
            $path = $avatar->storeAs('images', $filename);
    
            if ($request->file('avatar')->isValid()) {
                
                $merchant->avatar = $path;
    
            }
        }
           if ($merchant->save())
           {
                return response()->json(['error' => false, 'message' => 'Merchant updated successfully with ID: ' . $id],200);
           }

        return response()->json(['error' => true, 'message' => 'Error updating merchant record'],200);

        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
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
