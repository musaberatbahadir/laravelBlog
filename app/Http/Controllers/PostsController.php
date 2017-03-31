<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
    	return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
    	return view('posts.show',compact('post'));
    }

    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required',
            'body'  => 'required'
        ]);

        Post::create(request(['title','body']));


        //And then redirect to the home page
        return redirect('/');
    }
    public function nigga()
    {
        return Post::with('comments')->get();
    }

    public function nigga2()
    {
        $posts = Post::with('comments')->get();
        foreach ($posts as $post => $value) {
            # code...
        }
    }
}

