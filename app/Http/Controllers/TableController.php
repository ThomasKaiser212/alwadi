<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{


    public function index(Request $request){

            if (!Auth::user()->bookings()->where('is_paid', true)->exists()) {
                return redirect()->route('home')->with('error', 'يجب عليك حجز غرفة اولا ');
            }
          return view('tables.index');
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'number_of_tables' => 'required|integer',
            'number_of_chairs' => 'required|integer',
            'reservation_start' => 'required|date',
            'reservation_end' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $table = new Table();
        $table->user_id = Auth::id();
        $table->type = $request->type;
        $table->number_of_tables = $request->number_of_tables;
        $table->number_of_chairs = $request->number_of_chairs;
        $table->reservation_start = $request->reservation_start;
        $table->reservation_end = $request->reservation_end;
        $table->notes = $request->notes;
        $table->save();

        return redirect()->back()->with('success', 'تم حجز الطاولة بنجاح!');
    }
}
