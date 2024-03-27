<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AfishaController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('afisha', compact('posts'));
        
    }
}
