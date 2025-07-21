<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(){
        $posts = auth()->user()->posts()->orderBy('created_at', 'desc')->get();
        return view('profile.profile',  ['posts' => $posts]);
    }

    public function show($id){
        abort(404);
    }

    public function create(){
        abort(404);
    }

    public function store(){
        abort(404);

    }

    public function edit($id){
        if ($id != auth()->id()) {
            abort(403);
        }
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id){

        if ($id != auth()->id()) {
            abort(403);
        }
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id ,
            'pfp' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'bio' => 'nullable|string|max:1000',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio,
        ];

        if ($request->hasFile('pfp')) {
            $file = $request->file('pfp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['pfp'] = 'uploads/' . $filename;
        }

        $user->update($data);

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id){

        if ($id != auth()->id()) {
            abort(403);
        }

        $user = User::find($id);

        Auth::logout();

        $user->delete();

        return redirect()->route('login')->with('success', 'User deleted successfully.');
    }

}
