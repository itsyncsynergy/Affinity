<?php

namespace App\Http\Controllers;

use App\Countries
use App\States
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountriesController extends Controller
{
    public function index(){
    
		$countries = Countries::select('name')->distinct()->get();

		
        return response()->json(['error' => false, 'countries' => $countries],200);
	
	}

	// public function getState(Request $request){
    
 //        $states = States::where('country_id', $request->input('country_id'))->orderBy('id', 'asc')->get()->toArray();

 //        return response()->json(['error' => false, 'states' => $states],200);
    
 //    }
}
