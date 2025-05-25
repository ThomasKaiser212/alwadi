<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Meal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{


    public function index(Request $request){

            if (!Auth::user()->bookings()->where('is_paid', true)->exists()) {
                return redirect()->route('home')->with('error', 'يجب عليك حجز غرفة اولا ');
            }
            return view('cars.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'destination' => 'required|string',
            'reservation_time' => 'required|date',
            'number_of_people' => 'required|integer|min:1|max:3',
        ]);

        // Create and save the car reservation
        $car = new Car();
        $car->user_id = Auth::id();
        $car->full_name = $request->full_name;
        $car->phone_number = $request->phone_number;
        $car->destination = $request->destination;
        $car->reservation_time = $request->reservation_time;
        $car->number_of_people = $request->number_of_people;
        $car->save();

        // Format reservation time
        $reservationTime = Carbon::parse($request->reservation_time)->format('H:i');

        // Return success message with formatted reservation time
        return redirect()->back()->with('success', "تم حجز السيارة بنجاح ! يرجى النزول على الموعد المحدد عند الساعة {$reservationTime}");
    }
}
