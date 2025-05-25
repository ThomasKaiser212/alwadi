<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::whereDoesntHave('bookings')->get();

        return view('rooms.index', compact('rooms'));
    }
}
