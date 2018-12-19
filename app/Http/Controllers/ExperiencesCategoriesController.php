<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\ExperienceCategories;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExperiencesCategoriesController extends Controller
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

        $categories = ExperienceCategories::all();
        
        return view('admin_excategories')->with(['user'=> $user, 'categories'=> $categories]);

    }

    public function getExpCat()
    {
        $exp_cat = ExperienceCategories::all();

        // return response()->json(['error' => false, 'donation_categories' => $don_cat], 200);

        return $exp_cat;
    }

    public function store(Request $request)
    {
       $categories = new ExperienceCategories;

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

        $categories = ExperienceCategories::where('category_id', $request->input('category_id'))->first();

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


    public function delete($id)
    {
        $categories = ExperienceCategories::where('category_id', $id)->first();


        if($categories->delete()){
            Session::flash('success', 'Category has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }


}
