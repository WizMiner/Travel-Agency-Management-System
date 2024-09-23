<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use App\Models\city\city;
use App\Models\Country\Country;
use Illuminate\Http\Request;

class TravelingController extends Controller
{
    public function about($id){
        $cities = City::select()->orderBY('id', 'desc')->take(5)->where('country_id', $id)->get();

        $country = Country::find($id);

        $citiesCount = city::select()->where('country_id', $id)->count();

        return view('traveling.about', compact('cities', 'country', 'citiesCount'));
    }


    public function makeReservations($id){

        $city = city::find($id);

        return view('traveling.reservation', compact('city'));

    }
}
