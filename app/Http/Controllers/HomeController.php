<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


        public function index()
        {
            // $rooms = Room::limit(4)->get();
            // $tables = RestaurantTable::limit(4)->get();
            // $meals = RestaurantMeal::limit(4)->get();
            // $taxiBookings = TaxiBooking::limit(4)->get();

            return view('home');

        }
    }
