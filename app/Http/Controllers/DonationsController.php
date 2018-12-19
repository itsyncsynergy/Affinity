<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\Donation;
use App\DonationCategories;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationsController extends Controller
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

        $categories = DonationCategories::all();

        $results = DB::table('donations')
        ->join('donation_categories', 'donations.category_id', '=', 'donation_categories.category_id')
        ->select('donations.*', 'donation_categories.cate_title')
        ->get();

        return view('admin_donations')->with(['user'=> $user, 'results'=> $results, 'categories' => $categories]);

    }

    public function getDonations($id)
    {
        try
        {
            $donation = DB::table('donations')
            ->leftjoin('donation_categories', 'donations.category', '=', 'donation_categories.category_id')
            ->select('donations.id as category_id', 'donations.title as cate_title', 'avatar')
            ->where('donations.category', $id)
            ->get();

            return $donation;
        }
        catch (ModelNotFoundException $ex)
        {
            // Record not found... return error message
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
        
    }

    public function fetchDonation($id)
    {
        $donation = Donation::where('id', $id)->first();

        return $donation;
    }

   
    public function store(Request $request)
    {
        $donation= new Donation;

        $donation->title = $request->input('title');

        $donation->post = $request->input('post');

        $donation->website = $request->input('website'); 

        $donation->phone = $request->input('phone'); 

        $donation->needtoknow = $request->input('needtoknow'); 

        $donation->category_id = $request->input('category_id'); 

        $avatar = $request->file('avatar'); 
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $donation->avatar = $path;
        


       if($donation->save()){
            Session::flash('success', 'New Donation has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Process execution failed');
            return back();
        }   

    }

    public function deleteFile(Request $request)
    {
        File::delete($request->input('avatar'));

        $gallery = GroupGallery::where('group_id', $id)->first();

        $gallery->group_id = $request->input('group_id');


        if($gallery->delete()){
            Session::flash('success', 'Image has been deleted');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not delete image');
            return back();
        }  
    }    

    public function update(Request $request)
    {
        $donation = Donation::where('id', $request->input('donation_id'))->first();

        $donation->title = $request->input('title');

        $donation->post = $request->input('post');

        $donation->website = $request->input('website'); 

         $donation->phone = $request->input('phone'); 

        $donation->needtoknow = $request->input('needtoknow'); 

        $donation->category_id = $request->input('category_id'); 

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $donation->avatar = $path;
        }


        if($donation->save()){
            Session::flash('success','Donation has been Updated Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        }   

    }

    public function delete($id)
    {
        $donation = Donation::where('id', $id)->first();

        if($donation->delete()){
            Session::flash('success', 'Donation has been Deleted Successfully');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        } 
    }

}
