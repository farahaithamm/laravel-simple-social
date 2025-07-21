<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view('posts.index', ['posts' => $posts, 'users' => $users]);
    }

    public function show($id){
        $post = Post::with('comments.user')->find($id);

        if ($post === null) {
            return to_route('posts.index');
        }

        return view('posts.show', ['post' => $post]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        $data = request()->all();

        $data = request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    public function edit($id){
        $post = Post::find($id);
        $users = User::all();

        if ($post === null) {
            return to_route('posts.index');
        }
        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function update($id){
        $data = request()->all();
        $post = Post::find($id);

        if ($post === null) {
            return to_route('posts.index');
        }

        $data = request()->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $post->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', $post)->with('success', 'Post edited successfully.');
    }

    public function destroy($id){
        $post = Post::find($id);

        if ($post === null) {
            return to_route('posts.index');
        }

        $post->delete();

        return to_route('posts.index');
    }

}
