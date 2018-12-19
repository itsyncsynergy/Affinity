<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\GlobalVipEventCategories;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VipEventCategoriesController extends Controller
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

        $categories = GlobalVipEventCategories::all();
        
        return view('admin_global_vip_categories')->with(['user'=> $user, 'categories'=> $categories]);

    }

    public function getCategories()
    {
        $don_cat = GlobalVipEventCategories::all();

        return $don_cat;
    }

    public function store(Request $request)
    {
        $categories = new GlobalVipEventCategories;

        $categories->cate_title = $request->input('title');


        if($categories->save()){
            Session::flash('success', 'New Category has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Process execution failed');
            return back();
        } 

    }

    public function update(Request $request)
    {

        $categories = GlobalVipEventCategories::where('category_id', $request->input('category_id'))->first();

        $categories->cate_title = $request->input('title'); 

        if($categories->save()){
            Session::flash('success', 'Category Name has been Updated Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }


    public function delete($id)
    {
        $categories = GlobalVipEventCategories::where('category_id', $id)->first();


        if($categories->delete()){
            Session::flash('success', 'Category has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }


}
