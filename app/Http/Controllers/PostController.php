<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Comment;

class PostController extends Controller
{
    public function index()
    {
        
        $allPosts = Post::paginate(10); //select * from posts
        //dd($allPosts);
        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        $comments = $post->comments;
        //dd($comments);
        return view('post.show',["comments"=>$comments],['post' => $post]);
//        dd($post);

        return view('post.show', ['post' => $post]);
    }

    public function create(){
        $users = User::all();

        return view('post.create', ['users' => $users]);
        // return view('post.create');
    }

    
    public function store(Request $request)
    {
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

           //insert the form data in the database
           Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);


       //redirect to index route
       return to_route('posts.index');
    }

    public function edit($id){
        $users = User::all();
        $post = Post::find($id);

        return view('post.edit', ['post' => $post,'users' => $users]);
    }

    public function update(Request $request, $id){
        $post = post::find($id);
        $post->update(
            [
                //column name -> came data of name of input
               'title'=> request()->title,
               'description'=> request()->description,
               'user_id' => $request->post_creator,
            
            ]);
        return to_route('posts.index')->with('success', 'A Post is Updated Successfully!');
    }


    public function destroy($id){
        $post = Post::where('id', $id)->first();
        $post->delete();
        return redirect()->route('posts.index', $post['user_id'] );
    }
}