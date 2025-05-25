<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Meal;
use App\Models\Room;
use App\Models\Table;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{


    public function index()
    {

        $roomBookings = Booking::where('user_id', auth()->id())->where('bookable_type', 'Room')->get();
        $mealBookings = Booking::where('user_id', Auth::id())->with('user')
            ->where('bookable_type', 'Meal')
            ->with('bookable')
            ->get();
        $carBookings = Car::where('user_id', auth()->id())->get();
        $tableBookings = Table::where('user_id', auth()->id())->get();

        return view('booking.booking', compact('roomBookings', 'mealBookings', 'carBookings', 'tableBookings'));
    }




    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'card_number' => 'required|digits:16',
            'expiry_date' => 'required|date_format:m/y',
            'cvv' => 'required|digits:3',
        ]);


        $room = Room::findOrFail($request->room_id);


        $booking = new Booking([
            'user_id' => Auth::id(),
            'check_in' => now(),
            'check_out' => now()->addDays(1),
            'is_paid' => true,
        ]);


        $room->bookings()->save($booking);

        return response()->json(['success' => 'تم حجز الغرفة بنجاح!']);
    }


    public function allbooking()
    {

        $reservedRooms = Room::whereHas('bookings', function ($query) {
            $query->with('user');
        })->with('bookings.user')->get();


        $orderedMeals = Meal::whereHas('bookings', function ($query) {
            $query->with('user');
        })->with('bookings.user')->get();

        $reservedCars = Car::with('user')->get();

        $reservedTables = Table::with('user')->get();

        $users = User::where('is_admin', false)->get();

        return view('admin.admin', compact('reservedRooms', 'orderedMeals', 'reservedCars', 'reservedTables', 'users'));

    }
}
