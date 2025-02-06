<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Masterclass;
use App\Models\Seat;
use App\Models\Gallery;

class AdminController extends Controller
{
    public $dates=array(
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
        return redirect("account");
    }
    public function edit(Request $request)
    {
        $user = User::find($request->userId);
        $user->update([
            'discount' => $request->discount . '%',
        ]);
        return redirect('/admin');
    }
    public function publishMasterclass(Request $request,)
    {
        $masterclass = Masterclass::find($request->masterclassId);
        $masterclass->update([
            'status' => 1,
        ]);

        return redirect('/admin');
    }
    public function declineMasterclass(Request $request,)
    {
        $masterclass = Masterclass::find($request->masterclassId);
        $masterclass->update([
            'status' => 2,
            'decline_message' => $request->decline_message,
        ]);

        return redirect('/admin');
    }
}
