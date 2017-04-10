<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Elasticsearch\ClientBuilder;

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
        try {
            $post = Post::create(request(['title','body']));
        } catch (Exception $e) {
            Log::error("PostsController/Given title and body couldnt take a post", (array) $e);
        }
        $client = ClientBuilder::create()->build();
        try {
            $client->index([
            'index' => 'blog',
            'type' => 'post',
            'id' => $post->id,
            'body' => [
                'docTitle' => $post->title,
                'docBody' => $post->body
            ]
        ]);
        } catch (Exception $e) {
            Log::error("PostsController/Given title and body couldnt index", (array) $e);
        }
        
        //And then redirect to the home page
        return redirect('/');
    }

    public function deletePost(Post $post)
    {
        $client = ClientBuilder::create()->build();
        try {
            $client->delete([
            'index' => 'blog',
            'type' => 'post',
            'id' => $post->id
        ]);
        } catch (Exception $e) {
            Log::error("PostsController/Couldnt delete from elasticsearch server", (array) $e);
        }
                
        $post->delete();
    }

    public function updatePost(Post $post, Request $request)
    {
        $post->forceFill(
            $request->only([
                'title', 'body'
            ])
        )->save();
        $client = ClientBuilder::create()->build();
        try {
            $client->index([
            'index' => 'blog',
            'type' => 'post',
            'id' => $post->id,
            'body' => [
                'docTitle' => $post->title,
                'docBody' => $post->body
            ]
        ]);
        } catch (Exception $e) {
            Log::error("PostsController/There is an error when you try to index while updating", (array) $e);
        }
        
    }

    public function showUpdatePage(Post $post)
    {
        return view('posts.update',compact('post'));
    }

    public function search(Request $request)
    {
        $key = $request->input('q');

        try {
            $params = [
            'index' => 'blog',
            'type' => 'post',
            'body' => [
                'query' => [
                    'match' => [
                        'docBody' => $key
                    ]
                ]
            ]
        ];
        $client = ClientBuilder::create()->build();
        $results = $client->search($params);
        } catch (Exception $e) {
            Log::error("PostsController/Searching error occured", (array) $e);
        }
                
        dd($results);

    }
}