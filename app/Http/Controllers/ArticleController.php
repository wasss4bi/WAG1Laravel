<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index(){
        $article = Article::find(1);
        dd($article->title);
        
    }

}
