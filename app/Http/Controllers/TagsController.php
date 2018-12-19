<?php

namespace App\Http\Controllers;

use Session;
use App\Tags;
use App\TagItem;
use App\BespokeProduct;
use App\CustomerGroup;
use App\MerchantOffer;
use App\GroupPost;
use App\Group;
use App\Merchant;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
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

        $tags = Tags::all();
        
        $admins = Admin::all();
        
        return view('admin_tags')->with(['user'=> $user,'admins'=> $admins, 'tags'=> $tags]);

    }

    public function store(Request $request)
    {
        $tag = new Tags;

        $tag->tag_name = $request->input('tag_name');

        if ($tag->save()) {

            Session::flash('success', 'New Tag created Successfully');
            return back();

        } else {

            Session::flash('error', 'Unable to create tag');
            return back();

        }
        

    }

    public function delete($id)
    {
       $tag = Tags::where('tag_id', $id)->first();

       if ($tag->delete()) {
           
            Session::flash('success', 'Tag Deleted Successfully!!!');
            return back();

       } else {

           Session::flash('error', 'Tag Cannot be Deleted!!!');
            return back();

       }
       
    }

    public function update(Request $request)
    {
        $tag = Tags::where('tag_id', $request->input('tag_id'))->first();

        $tag->tag_name = $request->input('tag_name');

        if ($tag->save()) {
            
            Session::flash('success', 'Tag Updated Successfully!!!');
            return back();

        } else {

            Session::flash('error', 'Tag Cannot be Updated Successfully!!!');
            return back();
        }
        
    }

    //

    public function fetchProduct($id)
    {
        //Get the group which the customer belongs

        $user_group = CustomerGroup::where('customer_id', $id)
        ->select('group_id')
        ->get();
        $get_product = array();
        $get_offer = array();
        $count = 0;

        foreach ($user_group as $user) {


            $get_product1 = DB::select("SELECT bespoke_products.id, bespoke_products.name,bespoke_products.curr, bespoke_products.price, bespoke_products.supplier_name, bespoke_products.avatar, bespoke_products.details, bespoke_products.created_at FROM bespoke_products JOIN tag_item ON bespoke_products.id = tag_item.postID WHERE bespoke_products.created_at BETWEEN date_sub(CURDATE(), INTERVAL 6 DAY)  AND  date_add(CURDATE(), INTERVAL 1 DAY) AND tag_item.tag_id= $user->group_id LIMIT 2");


            foreach ($get_product1 as $key) {

                $count++;
                # code...
                $get_product[$count] = $key;
            }
        
        }

          if (sizeof($get_product) == 0) {
            
            $get_main_product = null;

        } else if (sizeof($get_product) >= 3) {

                $new = array_rand($get_product, 3);

                foreach ($new as $key) {

                    $get_main_product[] = $get_product[$key];
                
                 }

        } else if (sizeof($get_product) != 1 && sizeof($get_product) < 3)  {
            

                $new = array_rand($get_product, sizeof($get_product));

                foreach ($new as $key) {

                    $get_main_product[] = $get_product[$key];
                
                 }

                
                
        }else if (sizeof($get_product) == 1)  {

                $new = array_rand($get_product, sizeof($get_product));

                $get_main_product[] = $get_product[$new];
                
        }

        //Getting Offers section Starts here

        foreach ($user_group as $user) {


            $get_offer1 = DB::select("SELECT merchant_offers.offer_id, merchant_offers.merchant_id,merchant_offers.tagline, merchant_offers.avatar, merchants.name, merchant_offers.created_at FROM merchant_offers JOIN merchants ON merchant_offers.merchant_id = merchants.merchant_id JOIN tag_item ON tag_item.postID = merchant_offers.offer_id WHERE merchant_offers.created_at BETWEEN date_sub(CURDATE(), INTERVAL 6 DAY)  AND  date_add(CURDATE(), INTERVAL 1 DAY) AND tag_item.tag_id= $user->group_id LIMIT 2");


            foreach ($get_offer1 as $key) {

                $count++;
                # code...
                $get_offer[$count] = $key;
            }
        
        }

        if (sizeof($get_offer) == 0) {
            
            $get_main_offer = null;

        } else if (sizeof($get_offer) >= 3) {

                $new = array_rand($get_offer, 3);

                foreach ($new as $key) {

                    $get_main_offer[] = $get_offer[$key];
                
                 }

        } else if (sizeof($get_offer) != 1 && sizeof($get_offer) < 3)  {
            // dd(sizeof($get_event));

                $new = array_rand($get_offer, sizeof($get_offer));

                foreach ($new as $key) {

                    $get_main_offer[] = $get_offer[$key];
                
                 }

                // $get_main_event[] = $get_event[$new];
                
        }else if (sizeof($get_offer) == 1)  {

                $new = array_rand($get_offer, sizeof($get_offer));

                $get_main_offer[] = $get_offer[$new];
                
        }
 
        

        // return $get_main_product;

        return response()->json([
            'product' => $get_main_product,
            'offer' => $get_main_offer
        ]);

    }

    public function SocialWire($id)
    {
       //Get the group which the customer belongs
        $user_group = CustomerGroup::where('customer_id', $id)
        ->select('group_id')
        ->get();
        //Declare empty array 
        $get_event = array();
        $get_experience = array();
        $get_post = array();
        //Set count to zero
        $count = 0;

        //Loop through the customer group then fetch events tagged to the group

        foreach ($user_group as $user) {


            $get_event1 = DB::select("SELECT events.event_id, events.name, events.location, events.avatar, events.description,events.curr, events.price, events.date, events.created_at FROM events JOIN tag_item ON tag_item.postID = events.event_id WHERE events.created_at BETWEEN date_sub(CURDATE(), INTERVAL 6 DAY)  AND  date_add(CURDATE(), INTERVAL 1 DAY) AND tag_item.tag_id= $user->group_id LIMIT 2");


            foreach ($get_event1 as $key) {

                $count++;
                # code...
                $get_event[$count] = $key;
            }
        
        }

        //Then check for number of records and limit the result

         if (sizeof($get_event) == 0) {
            
            $get_main_event = null;

        } else if (sizeof($get_event) >= 3) {

                $new = array_rand($get_event, 3);

                foreach ($new as $key) {

                    $get_main_event[] = $get_event[$key];
                
                 }

        } else if (sizeof($get_event) != 1 && sizeof($get_event) < 3)  {
            // dd(sizeof($get_event));

                $new = array_rand($get_event, sizeof($get_event));

                foreach ($new as $key) {

                    $get_main_event[] = $get_event[$key];
                
                 }

                // $get_main_event[] = $get_event[$new];
                
        }else if (sizeof($get_event) == 1)  {

                $new = array_rand($get_event, sizeof($get_event));

                $get_main_event[] = $get_event[$new];
                
        }

        //Loop through the customer group then fetch experience tagged to the group

        foreach ($user_group as $user) {


            $get_experience1 = DB::select("SELECT experiences.experience_id, experiences.experience_name, experiences.venue,experiences.state, experiences.avatar, experiences.curr, experiences.price, experiences.experience_start_date, experiences.created_at FROM experiences JOIN tag_item ON tag_item.postID = experiences.experience_id WHERE experiences.created_at BETWEEN date_sub(CURDATE(), INTERVAL 6 DAY)  AND  date_add(CURDATE(), INTERVAL 1 DAY) AND tag_item.tag_id= $user->group_id LIMIT 2");


            foreach ($get_experience1 as $key) {

                $count++;
                # code...
                $get_experience[$count] = $key;
            }
        
        }

         //Then check for number of records and limit the result

        if (sizeof($get_experience) == 0) {
            
            $get_main_experience = null;

        } else if (sizeof($get_experience) >= 3) {

                $new = array_rand($get_experience, 3);

                foreach ($new as $key) {

                    $get_main_experience[] = $get_experience[$key];
                
                 }

        } else if (sizeof($get_experience) != 1 && sizeof($get_experience) < 3)  {
            // dd(sizeof($get_event));

                $new = array_rand($get_experience, sizeof($get_experience));

                foreach ($new as $key) {

                    $get_main_experience[] = $get_experience[$key];
                
                 }

                // $get_main_event[] = $get_event[$new];
                
        }
        else if (sizeof($get_experience) == 1)  {

                $new = array_rand($get_experience, sizeof($get_experience));

                $get_main_experience[] = $get_experience[$new];
                
        }

        //Loop through the customer group then fetch post tagged to the group group_post table

        foreach ($user_group as $user) {


            $get_post1 = DB::select("SELECT group_posts.id, group_posts.title, group_posts.post, group_posts.avatar, group_posts.created_at FROM group_posts  WHERE group_posts.created_at BETWEEN date_sub(CURDATE(), INTERVAL 6 DAY)  AND  date_add(CURDATE(), INTERVAL 1 DAY) AND group_posts.group_id= $user->group_id LIMIT 2");

            //loop through the result
            foreach ($get_post1 as $key) {

                $count++;
                # code...
                $get_post[$count] = $key;
            }
        
        }

         //Then check for number of records and limit the result

        if (sizeof($get_post) == 0) {
            
            $get_main_post = null;

        } else if (sizeof($get_post) >= 3) {

                $new = array_rand($get_post, 3);

                foreach ($new as $key) {

                    $get_main_post[] = $get_post[$key];
                
                 }

        } else if (sizeof($get_post) != 1 && sizeof($get_post) < 3)  {
            // dd(sizeof($get_event));

                $new = array_rand($get_post, sizeof($get_post));

                foreach ($new as $key) {

                    $get_main_post[] = $get_post[$key];
                
                 }

                // $get_main_event[] = $get_event[$new];
                
        }
        else if (sizeof($get_post) == 1)  {

                $new = array_rand($get_post, sizeof($get_post));

                $get_main_post[] = $get_post[$new];
                
        }




        return response()->json([
            'event' => $get_main_event,
            'experience' => $get_main_experience,
            'interest' => $get_main_post
        ]);

    }

    public function getPosts($id)
    {

        $post = GroupPost::where('id', $id)->first();

        $group_id = $post->group_id;

        $group = Group::where('group_id', $group_id)->first();

        $name = $group->name;

        $post['name'] = $name;

       return $post;
       
    }
   

  
}