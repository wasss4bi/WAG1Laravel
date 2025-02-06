<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Masterclass;
use App\Models\Seat;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Cabinet;

class AccountController extends Controller
{
    public $dates = array(
        '8:45-10:15',
        '10:25-11:55',
        '12:35-14:05',
        '14:15-15:45',
        '15:55-17:25',
        '17:30-19:00',
        '19:05-20:35',
    );
    public function index()
    {
        $publishedMasterclasses = Masterclass::where('status', 1)->get();
        $dates = $this->dates;
        $seats = Seat::all();
        $users = User::all();
        $masterclasses = Masterclass::all();
        $events = Event::all();
        $galleries = Gallery::all();
        $cabinets = Cabinet::all();
        return view('accounts.account', compact('users', 'masterclasses', 'seats', 'dates', 'publishedMasterclasses', 'events', 'galleries', 'cabinets'));
    }
    public function cancel(Request $request)
    {
        Seat::where('user_id', $request->user_id)->where('event_id', $request->event_id)->delete();
        return redirect('account');
    }
    public function edit_user(Request $request)
    {
        User::find($request->user_id)->update([
            'name' => $request->user_name,
            'role' => $request->user_role,
        ]);
        if ($request->user_role == 'admin') {
            return redirect('/admin');
        }
        return redirect('account');
    }
}
