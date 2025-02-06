<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masterclass;
use App\Models\Seat;
use App\Models\User;
use App\Models\Event;
use App\Models\Gallery;

class MasterclassController extends Controller
{
    public function index($id, $event_id)
    {
        $masterclass = Masterclass::find($id);
        $seats = Seat::where('event_id', $event_id)->get();
        $booked_seats = [];
        foreach ($seats as $seat) {
            $booked_seats[] = $seat->seat_num;
        }
        $event = Event::find($event_id);
        $users = User::all();
        $galleries = Gallery::all();
        return view('masterclass', compact('masterclass', 'event_id', 'seats', 'booked_seats', 'users', 'event', 'galleries'));
    }
}
