<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    //country list
    public function countries(){
        $countries=Country::all();
        return response()->json([
            'status'=>true,
            'message'=>'Country List',
            'data'=>$countries
        ],200);
    }

    //state by country
    public function stateByCountry(Request $request){
        $states=Country::find($request->country_id)->states;
        return response()->json([
            'status'=>true,
            'message'=>'State List',
            'data'=>$states
        ],200);
    }

    //city by state
    public function cityByState(Request $request){
        $cities=Country::find($request->country_id)->states->find($request->state_id)->cities;
        return response()->json([
            'status'=>true,
            'message'=>'City List',
            'data'=>$cities
        ],200);
    }
}
