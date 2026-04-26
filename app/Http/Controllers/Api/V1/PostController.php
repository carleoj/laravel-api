<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource. (GET)
     */
    public function index()
    {
        return PostResource::collection(Post::with('author')->paginate());
    }

    /**
     * Store a newly created resource in storage. (POST)
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = 1;

        $post = Post::create($data);
        return response()->json(new PostResource($post), 201);
    }

    /**
     *  Display the specified resource. (GET w/ param)
     */
    public function show(Post $post)
    {
        return new PostResource($post);
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
        return new PostResource($post);
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
