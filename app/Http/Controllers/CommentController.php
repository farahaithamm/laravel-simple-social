<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(){
        abort(404);
    }

    public function show(){
        abort(404);
    }

    public function create(){
        abort(404);
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Comment::create([
            'body' => $request->body,
            'post_id' => $post->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Comment added successfully.');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('comments.edit', ['comment'=> $comment]);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'body' => 'required|string',
        ]);

        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('posts.show', $comment->post_id)->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully.');
    }

}
