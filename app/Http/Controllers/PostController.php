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
        //dd(request());
        $allPosts = Post::paginate(10); //select * from posts
        //dd($allPosts);
        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        $comments = $post->comments;
        //dd($post);
        return view('post.show',["comments"=>$comments,'post' => $post]);
    }

    public function create(){
        $users = User::all();

        return view('post.create', ['users' => $users]);
        
    }

    
    public function store(StorePostRequest $request)
    {
        // dd($request);
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', ['disk' => "public"]);
        }
           //insert the form data in the database
           $post = Post::create([
            'title' =>  $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
            'image' => $path
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
        if ($request->hasFile("image")) {
            if ($post->image_path) //check if not null (no image)
                Storage::disk("public")->delete($post->image_path);
            $path = $request->file('image')->store('posts', ['disk' => "public"]);
        } else {
            $path = $post->image_path;
        }
 
        
        $post->update(
            [
                //column name -> came data of name of input
               'title'=> $request->title,
               'description'=> $request->description,
               'user_id' => $request->post_creator,
               'slug' => Str::of($request->title)->slug('-'), //for update slug when update title
               'image' => $path
            ]);
        return to_route('posts.index')->with('success', 'A Post is Updated Successfully!');
    }


    public function destroy($id){
        $post = Post::where('id', $id)->first();
        $post->delete();
        return redirect()->route('posts.index', $post['user_id'] );
    }

    public function removeOldPosts()
    {
        PruneOldPostsJob::dispatch();
        return to_route('posts.index')->with('success', 'An old Post is deleted Successfully!');
    }
}