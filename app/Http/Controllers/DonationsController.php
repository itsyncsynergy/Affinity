<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use App\Donation;
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

        $donations = Donation::all();
        
        return view('admin_donations')->with(['user'=> $user, 'donations'=> $donations]);

    }

   
    public function store(Request $request)
    {
        $donation= new Donation;

        $donation->title = $request->input('title');

        $donation->post = $request->input('post');

        $donation->website = $request->input('website'); 

        $avatar = $request->file('avatar'); 
        
        $extension = $avatar->extension();

        $filename = time();

        $path = 'images/'.$filename.'.'.$extension;

        move_uploaded_file($avatar, public_path($path));
        
        $donation->avatar = $path;
        


        if($donation->save()){
            Session::flash('success', $donation->type . ' has been created');
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

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar'); 
            
            $extension = $avatar->extension();

            $filename = time();

            $path = 'images/'.$filename.'.'.$extension;

            move_uploaded_file($avatar, public_path($path));
            
            $donation->avatar = $path;
        }


        if($donation->save()){
            Session::flash('success',$donation->title . ' has been updated');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not updated');
            return back();
        }  

    }

}
