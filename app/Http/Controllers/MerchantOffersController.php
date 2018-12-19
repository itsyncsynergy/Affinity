<?php

namespace App\Http\Controllers;

use Session;
use App\MerchantOffer;
use App\Admin;
use App\Merchant;
use App\Tags;
use App\Group;
use App\TagItem;
use App\OfferTarget;
use App\MerchantGallery;
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

        $offers = DB::table('merchant_offers')
        ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
        ->select('merchant_offers.*', 'merchants.name as merchant_name')
        ->orderBy('merchant_offers.created_at', 'desc')
        ->get();

        $expiry = DB::select("SELECT merchants.name AS merchant_name, DATEDIFF(merchant_offers.end_date, CURDATE()) AS diff, merchant_offers.*  FROM merchant_offers JOIN merchants ON merchants.merchant_id = merchant_offers.merchant_id WHERE date_format(end_date, '%Y-%m-%d') BETWEEN CURDATE() AND date_add(CURDATE(), INTERVAL 30 DAY)");

        return view('admin_merchants_offers')->with(['user'=> $user, 'offers'=> $offers, 'expiry' => $expiry]);
    }

    public function newOffer(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $merchants = Merchant::all();

        $tags = Group::all();
        
        return view('admin_offer_new')->with(['user'=> $user, 'merchants'=> $merchants, 'tags'=> $tags]);
    }

    public function NewOffers($id){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $merchant_id = $id;

        $tags = Group::all();
        
        return view('admin_offers_new')->with(['user'=> $user, 'merchant_id'=> $merchant_id, 'tags'=> $tags]);
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

        $tags = $request->input('tag_id');

        $target = $request->input('target_members');

        $postTypeID = 3;

        $offer = new MerchantOffer;

        $offer->merchant_id = $request->input('merchant_id');

        $offer->details = $request->input('details');
        
        $offer->target_members = implode(",",$request->input('target_members'));

        $offer->offer_name = $request->input('offer_name');

        $offer->offer_type = $request->input('offer_type');

        $offer->tagline = $request->input('tagline');

        $offer->start_date = substr( $request->input('date'), 0,10 );

        $offer->end_date = substr($request->input('date'), 13,21 + 1);

        $avatar = $request->file('avatar'); 

        $avatar = $request->file('avatar'); 

        $offer->avatar = $request->input('avatar');

        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $offer->avatar = $path;

        if($offer->save()){
            $offer_id = $offer->offer_id;

                foreach ($tags as $tag) {
                   
                    $taggedItem = new TagItem;

                    $taggedItem->tag_id = $tag;

                    $taggedItem->postID = $offer_id;

                    $taggedItem->postTypeID = $postTypeID;

                    $taggedItem->save();

                    
                }

                foreach ($target as $tar) {
                   
                    $offer_target = new OfferTarget;

                    $offer_target->target_members = $tar;

                    $offer_target->offer_id = $offer_id;

                    $offer_target->save();
   
                }
            Session::flash('success', 'Offer has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create offer');
            return back();
        }  
    }

    public function getcategories()
    {
        $offers = DB::table('merchant_categories')
        ->select('merchant_categories.category_id as category_id','merchant_categories.name as cate_title', 'merchant_categories.remarks as subtitle','merchant_categories.avatar as images', 'created_at', 'updated_at')
        ->orderBy('order_id', 'asc')
        ->get();

        return $offers;
    }

    public function getOffers($id)
    {
        $offers = DB::table('merchant_categories')
        ->join('merchants', 'merchant_categories.category_id', '=', 'merchants.category_id')
        ->select('merchants.merchant_id as category_id','merchants.name as cate_title', 'merchants.details as subtitle', 'merchants.avatar as images', 'merchants.created_at as created_at', 'merchants.updated_at as updated_at', 'merchants.state', 'merchants.city','merchants.country')
        ->whereIn('merchant_id', function($query) {
            $query->select('merchant_id')->from('merchant_offers');
        })
        ->where('merchants.category_id', $id)
        ->get();

        return $offers;
    }

    public function getOffer($id)
    {
        $offers = DB::table('merchants')
        ->join('merchant_offers', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
        ->select('merchant_offers.*', 'merchants.name')
        ->where('merchant_offers.merchant_id', $id)
        ->get();

        return $offers;

    }

    public function showOffer($id)
    {
        $offer = MerchantOffer::where('offer_id', $id)->first();

        return $offer;
    }

    public function getMerchant()
    {
        $merchants = DB::table('merchants')
       
        ->select('merchants.merchant_id as id', 'merchants.name')
        ->whereIn('merchant_id', function($query) {
            $query->select('merchant_id')->from('merchant_offers');
        })
        ->get();


        return $merchants;
    }

    public function singleMerchant($id)
    {
       $a1 = Merchant::where('merchant_id', $id)->first();

       $a2 = DB::table('transactions')
       ->where('merchant_id', $id)
       ->count();

       $offers = DB::table('merchant_offers')
       ->select('merchant_offers.*')
       ->where('merchant_id', $id)
       ->get();

       $gallery = MerchantGallery::where('merchant_id', $id)
       ->select('id', 'avatar as images')
       ->get();

        $gimage_ = null;
        if ($gallery->isEmpty()) {
            
            $gallery = null;

            $gimage = null;

       }else {

            $gimage = MerchantGallery::where('merchant_id', $id)
            ->select('avatar as images')
            ->first();
            $gimage_ = $gimage->images;
       }


       return response()->json([
        'error' => false,
        'reviews' => $a2,
        'merchant_details' => $a1,
        'offer' => $offers,
        'gallery' => $gallery,
        'gimage' => $gimage_,
        'code' => 1
        ], 200);

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

        // $offer = DB::table('merchant_offers')
        // ->join('merchants', 'merchants.merchant_id', '=', 'merchant_offers.merchant_id')
        // ->where('offer_id', $id)
        // ->select('merchant_offers.*', 'merchants.merchant_id as mer_id')
        // ->get()->toArray();

        $tags = Group::all();

        $eventTag = DB::table('groups')
        ->join('tag_item', 'groups.group_id', '=', 'tag_item.tag_id')
        ->select('groups.group_id', 'groups.name')
        ->where('tag_item.postID', $id)
        ->get();

        $offermerchant = DB::table('merchant_offers')
        ->join('merchants', 'merchant_offers.merchant_id', '=', 'merchants.merchant_id')
        ->select('merchant_offers.*', 'merchants.name')
        ->where('merchant_offers.offer_id', $id)
        ->get();

        // $offer = MerchantOffer::where('offer_id', $id)->first();
    
        return view('admin_offer_edit')->with(['user'=> $user, 'offermerchant'=> $offermerchant, 'tags' => $tags, 'eventTag'=> $eventTag]);
    }

    public function addTag(Request $request)
    {
        $tags = $request->input('tag_id');

        $postID = $request->input('offer_id');

        $postTypeID = 3;

        foreach ($tags as $tag) {
           
           $newItem = new TagItem;

           $newItem->tag_id = $tag;

           $newItem->postID = $postID;

           $newItem->postTypeID = $postTypeID;

           $newItem->save();

           
        }

        return back();

    }

    public function deleteTag($id, $offer_id)
    {
        $tag = TagItem::where([

                    ['tag_id', '=', $id],
                    ['postID', '=', $offer_id]
        ]);

        $tag->delete(); 

        return back();
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
        $target = $request->input('target_members');
        $offer = merchantOffer::where('offer_id', $request->input('offer_id'))->first();

        $offer->details = $request->input('details');

        if($request->input('target_members') != null){
            $offer->target_members = implode(",",$request->input('target_members'));

        }

        $offer->offer_name = $request->input('offer_name');

        $offer->offer_type = $request->input('offer_type');

        $offer->tagline = $request->input('tagline');

        $offer->start_date = substr( $request->input('date'), 0,10 );

        $offer->end_date = substr($request->input('date'), 13,21 + 1);

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
            $delete = OfferTarget::where('offer_id', $request->input('offer_id'));
            if ($delete->delete()) {

                if($target != null) {
    
                    foreach ($target as $tar) {
                        
                        $offer_target = new OfferTarget;
        
                        $offer_target->target_members = $tar;

                        $offer_target->offer_id = $request->input('offer_id');
        
                        $offer_target->save();
        
                    }
    
                }
            }
            
            
            Session::flash('success', 'Records has been updated Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not update offer');
            return back();
        }  
        
    }

    public function delete($id)
    {
       $offer = merchantOffer::where('offer_id', $id)->first();

        if($offer->delete()){
            Session::flash('success', 'Record has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
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
