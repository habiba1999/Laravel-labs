<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::with('user')->paginate(3);
        return PostResource::collection($allPosts);
        
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $post = Post::find($id);
            return new PostResource($post);
        }
    }

    public function store(StorePostRequest $request){
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', ['disk' => "public"]);
        }
        $post=Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->creator,
            'image' => $path
        ]);
        return $post;
    }


    
}
