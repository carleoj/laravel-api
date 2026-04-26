<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource. (GET)
     */
    public function index()
    {
        return Post::all();
    }

    /**
     * Store a newly created resource in storage. (POST)
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = 1;

        $post = Post::create($data);
        return response()->json($post, 201);
    }

    /**
     *  Display the specified resource. (GET w/ param)
     */
    public function show(Post $post) 
    {
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage. (PUT)
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|min:2',
            'body' => ['required', 'string', 'min:2']
        ]);

        $post->update($data);
        return $post;
    }

    /**
     * Remove the specified resource from storage. (DELETE)
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}
