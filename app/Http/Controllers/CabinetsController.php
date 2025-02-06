<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;

class CabinetsController extends Controller
{
    public function index(){
        $cabinets = Cabinet::all();
        return view('cabinets', compact('cabinets'));
    }
}
