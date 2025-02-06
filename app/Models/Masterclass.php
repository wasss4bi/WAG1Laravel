<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masterclass extends Model
{
    use HasFactory;
    protected $fillable = [
        'img_main',
        'title',
        'description',
        'price',
        'age_restriction',
        'status',
        'lector_id',
        'decline_message',
    ];
}
