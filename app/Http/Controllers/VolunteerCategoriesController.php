<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\VolunteerCategories;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VolunteerCategoriesController extends Controller
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

        $categories = VolunteerCategories::all();
        
        return view('admin_vcategories')->with(['user'=> $user, 'categories'=> $categories]);

    }

    public function getVonCat()
    {
        $von_cat = VolunteerCategories::all();

        return $von_cat;

        // return response()->json(['error' => false, 'volunteer_categories' => $von_cat], 200);

    }

    public function store(Request $request)
    {
       $categories = new VolunteerCategories;

        $categories->cate_title = $request->input('title');

        $categories->subtitle = $request->input('subtitle');

        $avatar = $request->file('avatar'); 
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $categories->images = $path;


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

        $categories = VolunteerCategories::where('category_id', $request->input('category_id'))->first();

        $categories->cate_title = $request->input('title'); 

        $categories->subtitle = $request->input('subtitle');

        if($categories->save()){
            Session::flash('success', 'Category Name has been Updated Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }

    public function delete(Request $request)
    {
        $categories = VolunteerCategories::where('category_id', $request->input('category_id'))->first();

        $categories->cate_title = $request->input('title'); 

        if($categories->delete()){
            Session::flash('success', 'Category has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }

}
