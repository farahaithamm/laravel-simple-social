<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:5',
        ]);

        $credintials = $request->only('email', 'password');

        if(Auth::attempt($credintials)){
            return redirect()->intended(route('posts.index'));
        }

        return redirect()->back()->withErrors(['email' => 'Login details are not valid']);
    }

    public function registration(){
        return view('registration');
    }

    public function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        if(!$user){
            return redirect(route('registration'))->with("error","Registration failed, try again");
        }

        return redirect(route('login'))->with("success","Registration success, Login to access home");
    }

    public function logout(){
        Session::flush();
        Auth::logout();

        return redirect(route('login'));
    }
}
