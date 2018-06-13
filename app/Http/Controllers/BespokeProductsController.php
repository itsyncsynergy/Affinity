<?php

namespace App\Http\Controllers;

use Session;
use App\BespokeProductCategory;
use App\BespokeProduct;
use App\BespokeProductRequest;
use App\BespokeProductGallery;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BespokeProductsController extends Controller
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

        $bespoke_products = DB::table('bespoke_products')->join('bespoke_product_categories','bespoke_product_categories.id','=','bespoke_products.bespoke_product_category_id')->select('bespoke_product_categories.name as category_name', 'bespoke_products.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_bespoke_products')->with(['user'=> $user,'admins'=> $admins, 'bespoke_products'=> $bespoke_products]);

    }

    public function requests()
    {
        //
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $bespoke_product_requests = DB::table('bespoke_product_requests')->join('customers','customers.customer_id','=','bespoke_product_requests.customer_id')->join('bespoke_products','bespoke_products.id','=','bespoke_product_requests.bespoke_product_id')->select('customers.phone','customers.firstname', 'customers.lastname', 'bespoke_products.*', 'bespoke_product_requests.*')->get()->toArray();
		
        $admins = Admin::all();
        
        return view('admin_bespoke_product_requests')->with(['user'=> $user,'admins'=> $admins, 'bespoke_product_requests'=> $bespoke_product_requests]);

    }

    public function newBespokeProduct(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        $categories = BespokeProductCategory::all();

        return view('admin_bespoke_product_new')->with(['user'=> $user, 'categories'=> $categories]);
    }

    public function editBespokeProduct($id){

        $gallery = DB::table('bespoke_product_gallery')->where('bespoke_product_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        $categories = BespokeProductCategory::all();
        //$members_joined = DB::table('customer_event')->where('event_id', $id)->join('customers','customers.customer_id','=','customer_event.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_event.*')->get()->toArray();

        $bespoke_product = DB::table('bespoke_products')->where('bespoke_products.id', $id)->join('bespoke_product_categories','bespoke_product_categories.id','=','bespoke_products.bespoke_product_category_id')->select('bespoke_product_categories.name as category_name', 'bespoke_products.*')->first();
        
        
        return view('admin_bespoke_product_edit')->with(['user'=> $user, 'categories'=> $categories, /*, 'members_joined'=> $members_joined,*/ 'gallery'=> $gallery, 'bespoke_product'=> $bespoke_product]);
    }

    public function upload(Request $request)
    {
        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));

        $gallery = new BespokeProductGallery;

        $gallery->bespoke_product_id = $request->input('bespoke_product_id');
        
        $gallery->avatar = $path;
        


        if($gallery->save()){
            Session::flash('success', 'Image has been uploaded');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not upload image');
            return back();
        }  
    }    


    public function updateAdmin(Request $request)
    {
        $bespoke_product_request = BespokeProductRequest::where('id', $request->input('id'))->first();

        $bespoke_product_request->in_charge = $request->input('in_charge');

        if($bespoke_product_request->save()){
            Session::flash('success', $bespoke_product_request->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $bespoke_product_request = BespokeProductRequest::where('id', $request->input('id'))->first();

        $bespoke_product_request->status = $request->input('status');

        if($bespoke_product_request->save()){
            Session::flash('success', 'Status has been set');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not set status');
            return back();
        }  

    }

    public function store(Request $request)
    {
        //
        $bespoke_product = new BespokeProduct;

        $bespoke_product->name = $request->input('name');

        $bespoke_product->price= $request->input('price');

        $bespoke_product->supplier_name = $request->input('supplier_name');

        $bespoke_product->bespoke_product_category_id = $request->input('bespoke_product_category_id');

       

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $bespoke_product->avatar = $path;
        


        if($bespoke_product->save()){
            Session::flash('success', 'Event '. $bespoke_product->name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create product');
            return back();
        }  

    }

    public function update(Request $request)
    {
        //
        $bespoke_product = BespokeProduct::where('id', $request->input('bespoke_product_id'))->first();

        $bespoke_product->name = $request->input('name');

        $bespoke_product->price = $request->input('price');

        $bespoke_product->supplier_name = $request->input('supplier_name');



        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $bespoke_product->avatar = $path;
        }


        if($bespoke_product->save()){
            Session::flash('success', 'Event '. $bespoke_product->name . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create category');
            return back();
        }  

    }



}
