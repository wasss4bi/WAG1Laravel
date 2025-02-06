<?php

namespace App\Http\Controllers;

use App\Models\Cabinet;

class CabinetController extends Controller
{
    public function index($id){
        $cabinet = Cabinet::find($id);
        return view('cabinet', compact('id', 'cabinet'));
    }
}
