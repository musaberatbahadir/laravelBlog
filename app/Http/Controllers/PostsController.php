<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Elasticsearch\ClientBuilder;

class PostsController extends Controller
{

    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

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

        $post = Post::create(request(['title','body']));

        $this->client->index([
            'index' => 'blog',
            'type' => 'post',
            'id' => $post->id,
            'body' => [
                'title' => $post->title,
                'body' => $post->body
            ]
        ]);

        //And then redirect to the home page
        return redirect('/');
    }

    public function deletepost(Post $post)
    {
        $this->client->delete([
            'index' => 'blog',
            'type' => 'post',
            'id' => $post->id
        ]);
        
        $post->delete();
    }
}

