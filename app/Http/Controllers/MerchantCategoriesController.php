<?php

namespace App\Http\Controllers;

use Session;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use App\MerchantCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MerchantCategoriesController extends Controller
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
		
        $categories = MerchantCategory::orderBy('category_id', 'desc')->get();

        return view('admin_merchant_categories')->with(['user'=> $user, 'categories'=> $categories]);
    }


    public function newMerchantCategory(){

        $user = Auth::user();
        $user = Admin::where('admin_id', $user->details_id)->first();

        return view('admin_merchant_category_new')->with(['user'=> $user]);
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
        $category = new MerchantCategory;

        $category->name = $request->input('name');

        $category->remarks = $request->input('remarks');

        if($category->save()){
            Session::flash('success', $category->name . ' has been created');
            return back();
        }else{
            Session::flash('error', 'An error occured. Could not create category');
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
            $category = MerchantCategory::findOrFail($id);

            return response()->json(['error' => false, 'category' => $category],200);

        }

        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try
        {

        $category = MerchantCategory::find($id);

        if ($request->has('name'))
            $category->name = $request->input('name');

        if ($request->has('remarks'))
            $category->remarks = $request->input('remarks');

           if ($category->save())
           {
                return response()->json(['error' => false, 'message' => 'Category updated successfully with ID: ' . $id],200);
           }

        return response()->json(['error' => true, 'message' => 'Error updating category record'],200);

        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
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

            $category = MerchantCategory::findOrFail($id);


            if ($category->delete())
            {

            return response()->json(['error' => false, 'message' => 'Category record deleted successfully'],200);
            
            }

            return response()->json(['error' => true, 'message' => 'Category record could not be deleted'],200);
        
        }
        catch (ModelNotFoundException $ex)
        {
            return response()->json(['error' => true, 'message' => 'Record not found'],404);
        }
    }

    /**
     * Function to fetch merchants associated with category
     *
     * @param  int  $category_id
     * @return \Illuminate\Http\Response
     */
    public function getMerchants($category_id)
    {
        //
        try
        {

            $category = MerchantCategory::findOrFail($category_id);

            $merchants = $category->merchants()->get()->toArray();

            return response()->json(['error' => false, 'merchants' => $merchants], 200);

        }
        catch (ModelNotFoundException $ex)
        {

            return response()->json(['error' => true, 'message' => 'Record not found'], 404);

        }         
    }
}
