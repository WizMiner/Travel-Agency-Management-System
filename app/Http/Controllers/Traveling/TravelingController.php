<?php

namespace App\Http\Controllers\Traveling;

use App\Http\Controllers\Controller;
use App\Models\city\city;
use App\Models\Country\Country;
use App\Models\Reservation\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class TravelingController extends Controller
{
    public function about($id)
    {
        $cities = City::select()->orderBY('id', 'desc')->take(5)->where('country_id', $id)->get();

        $country = Country::find($id);

        $citiesCount = city::select()->where('country_id', $id)->count();

        return view('traveling.about', compact('cities', 'country', 'citiesCount'));
    }


    public function makeReservations($id)
    {

        $city = City::find($id);

        return view('traveling.reservation', compact('city'));
    }

    public function storeReservations(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone_number' => 'required',
            'num_guests' => 'required|integer',
            'check_in_date' => 'required|date|after:today',
            'destination' => 'required',
        ]);

        $city = City::find($id);

        if (!$city) {
            return back()->withErrors(['city' => 'Invalid city ID.']);
        }
        // $totalPrice = $city->price * $request->num_guests;
        $totalPrice = (int)$city->price * $request->num_guests;


        $reservation = Reservation::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'num_guests' => $request->num_guests,
            'check_in_date' => $request->check_in_date,
            'destination' => $city->name,
            'price' => $totalPrice,
            'user_id' => Auth::user()->id,
        ]);

        if ($reservation) {
            Session::put('price', $totalPrice);
            // return view('traveling.success');

            return view('traveling.pay', compact('totalPrice'));
        } else {
            return back()->withErrors(['reservation' => 'An error occurred while creating your reservation.']);
        }
    }

    public function payWithPaypal(){

        return view('traveling.pay');
    }

    public function successPayed(){

        Session::forget('price');
        return view('traveling.success');
    }
}
