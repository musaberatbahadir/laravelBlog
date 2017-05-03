<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use App\Post;
use App\Comment;

class ApiController extends Controller
{
    
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

        $data = [];
        if (isset($results['hits']) and !empty($results['hits'])) {
            foreach ($results['hits']['hits'] as $r) {
                $data[] = $r['_source'];
            }
        }
        return response()->json($data);
    }

    public function allPosts()
    {
    		return Post::with('comments')->get();
    }

    public function specificPost(Post $post)
    {
    		return $post;
    }
    
}
