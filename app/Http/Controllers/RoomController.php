<?php

namespace App\Http\Controllers;

use App\Models\Post;

class RoomController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('room', compact('posts'));
        
    }
}
