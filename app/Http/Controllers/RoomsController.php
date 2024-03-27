<?php

namespace App\Http\Controllers;

use App\Models\Post;

class RoomsController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('rooms', compact('posts'));
        
    }
}
