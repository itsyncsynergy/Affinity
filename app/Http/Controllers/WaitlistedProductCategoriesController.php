<?php

namespace App\Http\Controllers;

use Session;
use App\WaitlistedProductCategory;
use App\Group;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaitlistedProductCategoriesController extends Controller
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

        $waitlisted_product_categories = waitlistedProductCategory::all();
		
        $admins = Admin::all();
        
        return view('admin_waitlisted_product_categories')->with(['user'=> $user,'admins'=> $admins, 'waitlisted_product_categories'=> $waitlisted_product_categories]);

    }

    public function newwaitlistedProductCategory(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        return view('admin_waitlisted_product_category_new')->with(['user'=> $user]);
    }

    public function editwaitlistedProductCategory($id){

        //$gallery = DB::table('waitlisted_product_category_gallery')->where('waitlisted_product_category_id', $id)->get()->toArray();
        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();
        
        //$members_joined = DB::table('customer_event')->where('event_id', $id)->join('customers','customers.customer_id','=','customer_event.customer_id')->select('customers.*', 'customers.avatar as customer_avatar', 'customer_event.*')->get()->toArray();

        $waitlisted_product_category = WaitlistedProductCategory::where('id', $id)->first();
        
        
        return view('admin_waitlisted_product_category_edit')->with(['user'=> $user,/*, 'members_joined'=> $members_joined, 'gallery'=> $gallery,*/ 'waitlisted_product_category'=> $waitlisted_product_category]);
    }

    public function updateAdmin(Request $request)
    {
        $waitlisted_product_categories = WaitlistedProductCategory::where('id', $request->input('id'))->first();

        $waitlisted_product_categories->in_charge = $request->input('in_charge');

        if($waitlistedProductCategory->save()){
            Session::flash('success', $waitlisted_product_categories->in_charge. ' has been assigned ');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not assign admin');
            return back();
        }  

    }

    public function updateStatus(Request $request)
    {
        $waitlisted_product_categories = WaitlistedProductCategory::where('id', $request->input('id'))->first();

        $waitlisted_product_categories->status = $request->input('status');

        if($waitlisted_product_categories->save()){
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
        $waitlisted_product_categories = new WaitlistedProductCategory;

        $waitlisted_product_categories->name = $request->input('name');

       

        $avatar = $request->file('avatar'); // create method to handle this section...
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $waitlisted_product_categories->avatar = $path;
        


        if($waitlisted_product_categories->save()){
            Session::flash('success', 'Event '. $waitlisted_product_categories->name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create product');
            return back();
        }  

    }

    public function update(Request $request)
    {
        //
        $waitlisted_product_category = WaitlistedProductCategory::where('id', $request->input('waitlisted_product_category_id'))->first();

        $waitlisted_product_category->name = $request->input('name');

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $waitlisted_product_category->avatar = $path;
        }


        if($waitlisted_product_category->save()){
            Session::flash('success', 'Event '. $waitlisted_product_category->name . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create category');
            return back();
        }  

    }



}
