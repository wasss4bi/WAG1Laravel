<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $fillable = [
        'cabinet_id',
        'masterclass_id',
        'event_date',
        'event_time'
    ];
    public $timestamps = false;
}
