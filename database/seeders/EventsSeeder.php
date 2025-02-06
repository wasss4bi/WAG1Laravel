<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('events')->truncate();
        $baseDate = Carbon::now(); // Получаем текущую дату

        DB::table('events')->insert([
            [
                "id" => 1,
                "cabinet_id" => 1,
                "masterclass_id" => 1,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "8:45-10:15"
            ],
            [
                "id" => 2,
                "cabinet_id" => 1,
                "masterclass_id" => 2,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "12:35-14:05"
            ],
            [
                "id" => 3,
                "cabinet_id" => 1,
                "masterclass_id" => 3,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "8:45-10:15"
            ],
            [
                "id" => 4,
                "cabinet_id" => 2,
                "masterclass_id" => 1,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "10:25-11:55"
            ],
            [
                "id" => 5,
                "cabinet_id" => 2,
                "masterclass_id" => 2,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "19:05-20:35"
            ],
            [
                "id" => 6,
                "cabinet_id" => 2,
                "masterclass_id" => 3,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "14:15-15:45"
            ],
            [
                "id" => 7,
                "cabinet_id" => 3,
                "masterclass_id" => 1,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "14:15-15:45"
            ],
            [
                "id" => 8,
                "cabinet_id" => 3,
                "masterclass_id" => 2,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "15:55-17:25"
            ],
            [
                "id" => 9,
                "cabinet_id" => 3,
                "masterclass_id" => 3,
                "event_date" => $baseDate->copy()->addDays(rand(0, 6))->format('d.m.y'),
                "event_time" => "12:35-14:05"
            ],
        ]);
    }
}
