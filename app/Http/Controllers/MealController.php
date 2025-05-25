<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\Meal;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
      public function index(Request $request){

            if (!Auth::user()->bookings()->where('is_paid', true)->exists()) {
                return redirect()->route('home')->with('error', 'يجب عليك حجز غرفة اولا ');
            }
            $meals =Meal::all();
            return view('meals.index', compact('meals'));
      }




    public function store(Request $request)
    {
                  //   dd($request);

        $validated = $request->validate([
            'meal_id' => 'required|exists:meals,id',
            'card_number' => 'required|digits:16',
            'expiry_date' => 'required|date_format:m/y',
            'cvv' => 'required|digits:3',
        ]);

        // Find the room by ID
        $meal = Meal::findOrFail($request->meal_id);

        // Create a new booking for the room
        $booking = new Booking([
            'user_id' => Auth::id(),
            'check_in' => now(),
            'check_out' => now()->addDays(1),
            'is_paid' => true,
        ]);

        // Associate the booking with the room
        $meal->bookings()->save($booking);

     //   return redirect()->back()->with('success', 'تم طلب الوجبة بنجاح!');
        return response()->json(['success' => 'تم طلب الوجبة بنجاح!']);
    }

}
