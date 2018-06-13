<?php

namespace App\Http\Controllers;

use App\Location;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LocationsController extends Controller
{
    public function index(){
    
		$countries = Location::select('country')->distinct()->get();

		
        return response()->json(['error' => false, 'countries' => $countries],200);
	
	}
	
	public function getState(Request $request){
    
		$states = Location::select('state')->where('country', $request->input('country'))->orderBy('state', 'asc')->get()->toArray();

		
        return response()->json(['error' => false, 'states' => $states],200);
	
	}
}
