<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Masterclass;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Cabinet;

class LecturerController extends Controller

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
        $cabinets = Cabinet::all();
        return view('cabinets', compact('cabinets'));
    }
    public function form($cabinet_id)
    {
        $users = User::all();
        $dates = $this->dates;
        $masterclasses = Masterclass::all();
        $events = Event::all();
        return view('lector', compact('users', 'dates', 'masterclasses', 'cabinet_id', 'events'));
    }
    public function create(Request $request)
    {
        $masterclass = [
            'img_main' => basename($request->file('img_main')->store('public/images')),
            'title' => $request->masterclass_title,
            'description' => $request->masterclass_description,
            'age_restriction' => $request->age_restriction,
            'price' => $request->masterclass_price,
            'lector_id' => $request->masterclass_lector_id,
        ];
        /* Создание мастер класса */
        Masterclass::create($masterclass);
        /* Добавление изображений в таблицу с галереей */
        if ($request->file('img_gallery')) {
            foreach ($request->file('img_gallery') as $image) {
                Gallery::create([
                    "masterclass_id" => Masterclass::latest()->first()->id,
                    "img_name" => basename($image->store('public/images')),
                ]);
            }
        }
        /* Добавление времён записи в таблицу с событиями */
        foreach ($request->keys() as $key) {
            if (preg_match('/rent/', $key, $word)) {
                preg_match('/rent_\d+\^\d+\^\d\d_(\d+\:\d+\-\d+\:\d+)/', $key, $time);
                preg_match('/rent_(\d+\^\d+\^\d+)/', $key, $date);
                Event::create([
                    'cabinet_id' => $request->cabinet_id,
                    'event_date' => preg_replace('/\^/', '.', $date[1]),
                    'masterclass_id' => Masterclass::latest()->first()->id,
                    'event_time' => $time[1],
                ]);
            }
        }
        return redirect('account');
    }
}
