<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();

        return view('post.index', compact('posts'));
        
    }

    public function create(){

        return view('post.create');
        /* $postsArr=[
            [
                'title' => 'bashka',
                'content' => 'concretniy',
                'image' => 'balbes',
                'likes' => 228,
                'is_published' => '1',
            ],
            [
                'title' => 'botan',
                'content' => 'lohozavr',
                'image' => 'smart',
                'likes' => 158,
                'is_published' => '1',
            ],
        ];
        foreach($postsArr as $post){
        Post::create($post); 
        }
        dd('posts created successfully'); */
    }

    public function store(){
        $data = request()->validate([
            'title' => 'string',
            'content' => 'string',
            'image' => 'string',
        ]);
        Post::create($data); 
        return redirect()->route('post.index');
    }
    public function show(Post $post){
        return view('post.show', compact('post'));
    }
    public function update(){
        $post=Post::find(3);
        
        $post->update([
            'title' => 'Verlieber',
            'content' => 'TUDUDUDU',
            'image' => '10 HOURS OF GRIME',
            'likes' => 2,
            'is_published' => '1',
        ]);
        dd('updated successfully');
    }

    public function delete(){
        $post=Post::find(2);
        
        $post->delete();
        dd('deleted successfully');
    }
    public function restore(){
        $post=Post::withTrashed()->find(2);
        $post->restore();
        dd('restored successfully');
    }

    // firstOrCreate

    public function firstOrCreate(){
        $anotherPost=[
            'content' => 'concretniy',
            'image' => 'balbes',
            'likes' => 228,
            'is_published' => '1',
        ];

        $post=Post::firstOrCreate([
            'title' => '23',
        ], $anotherPost);

        dump($post);
        dd('finished');

    }

    // updateOrCreate
    public function updateOrCreate(){
        $anotherPost=[
            'content' => 'GOH concretniy',
            'image' => 'GOH balbes',
            'likes' => 228,
            'is_published' => '1',
        ];
        $post=Post::updateOrCreate([
            'title' =>23 ,
        ], $anotherPost);
        dump($post);
        dd('finished');
    }
}
