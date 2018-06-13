<?php

namespace App\Http\Controllers;

use Session;
use App\MerchantOffer;
use App\Admin;
use App\Merchant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MerchantOffersController extends Controller
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

        $offers = DB::table('merchant_offers')->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
        ->select('merchant_offers.*', 'merchants.name as merchant_name')->orderBy('merchant_offers.created_at', 'desc')->get();

        return view('admin_merchants_offers')->with(['user'=> $user, 'offers'=> $offers]);
    }

    public function newOffer($merchant_id){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $merchant = Merchant::where('merchant_id', $merchant_id)->first();
        
        return view('admin_offer_new')->with(['user'=> $user, 'merchant'=> $merchant]);
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
        $offer = new MerchantOffer;

        $offer->merchant_id = $request->input('merchant_id');

        $offer->details = $request->input('details');
        
        $offer->target_members = implode(" ",$request->input('target_members'));

        $offer->offer_name = $request->input('offer_name');

        $offer->offer_type = $request->input('offer_type');

        $offer->tagline = $request->input('tagline');

        $offer->start_date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $offer->end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);

        $avatar = $request->file('avatar'); 

        $avatar = $request->file('avatar'); 

        $offer->avatar = $request->input('avatar');

        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $offer->avatar = $path;

        if($offer->save()){
            Session::flash('success', $offer->offer_name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create offer');
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
            $offer = MerchantOffer::where('offer_id', '=' ,$id)->firstOrFail();

            return response()->json(['error' => false, 'offer' => $offer],200);

        }

        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => $id],404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $offer = MerchantOffer::where('offer_id', $id)->first();
    
        return view('admin_offer_edit')->with(['user'=> $user, 'offer'=> $offer]);
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
        $offer = merchantOffer::where('offer_id', $request->input('offer_id'))->first();

        $offer->details = $request->input('details');

        if($request->input('target_members') != null){
            $offer->target_members = implode(" ",$request->input('target_members'));
        }

        $offer->offer_name = $request->input('offer_name');

        $offer->offer_type = $request->input('offer_type');

        $offer->tagline = $request->input('tagline');

        $offer->start_date = substr( $request->input('date'), 0, strrpos($request->input('date'), '-' ) );

        $offer->end_date = substr($request->input('date'), strpos($request->input('date'), "-") + 1);

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 

            $avatar = $request->file('avatar'); 

            $offer->avatar = $request->input('avatar');

            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $offer->avatar = $path;
        }

        if($offer->save()){
            Session::flash('success', $offer->offer_name . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not update offer');
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

            $offer = MerchantOffer::findOrFail($id);


            if ($offer->delete())
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
