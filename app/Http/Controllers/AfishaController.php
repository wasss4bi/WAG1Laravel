<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masterclass;
use App\Models\Event;
use App\Models\Seat;
use Illuminate\Http\JsonResponse;

class AfishaController extends Controller
{
    public function afisha_date($date)
    {
        $masterclasses = Masterclass::where('status', 1)->get();
        $events = Event::all();
        $seats   = Seat::all();
        $masterclasses = [];
        foreach ($masterclasses as $masterclass) {
            if ($events->where('masterclass_id', $masterclass->id)->where('event_date', $date)->all()) {
                $masterclasses[] = $masterclass;
            }
        }
        return view('afisha', compact('masterclasses', 'date', 'events', 'seats'));
    }
    public function delete(Request $request, $id)
    {
        $masterclass = Masterclass::find($id);
        if (!$masterclass) {
            return response()->json(['error' => 'masterclass not found'], 404);
        }

        $masterclass->delete();
        return response()->json(['message' => 'masterclass deleted successfully']);
    }
}
