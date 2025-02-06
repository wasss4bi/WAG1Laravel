<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;
use App\Models\Event;

class SeatController extends Controller
{
    public function booking(Request $request)
    {
        $masterclass_id = Event::find($request->event_id)->masterclass_id;
        if(empty(Seat::where('user_id', $request->user_id)
        ->where('event_id', $request->event_id)
        ->get()[0])){
            Seat::firstOrCreate([
                'event_id' => $request->event_id,
                'seat_num' => $request->seat_num,
                'user_id' => $request->user_id,
                'cabinet_id' => $request->cabinet_id,
            ]);
        }else{
            $error='Вы уже записаны на этот мастер-класс';
            return redirect("masterclass/$masterclass_id/$request->event_id",)->with('message', $error);
        };
        $message="Вы успешно записаны на мастер-класс!";
        return redirect("masterclass/$masterclass_id/$request->event_id",)->with('message', $message);
    }
}
