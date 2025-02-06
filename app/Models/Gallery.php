<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public $fillable =[
        'masterclass_id',
        'img_name'
    ];
    public $timestamps=false;
}
