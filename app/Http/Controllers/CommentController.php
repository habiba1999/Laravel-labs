<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store($id, Request $request)
    {
        $post = Post::find($request->post);
        $post->comments()->create($request->all());
        return redirect()->back();
    }

    public function destroy($id){
        $comment = Comment::where('id', $id)->first();
        // dd($id);
        $comment->delete();
        return redirect()->back();
    }
}
