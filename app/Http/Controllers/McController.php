<?php

namespace App\Http\Controllers;

use App\Models\Post;

class McController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('mc', compact('posts'));
        
    }
}
