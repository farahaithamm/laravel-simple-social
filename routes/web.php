<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/registration', [AuthController::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Posts
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('user', UserController::class);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('profile/{id}', function($id){
        if ($id == auth()->id()) return redirect()->route('user.index');

        $user = User::find($id);
        if (!$user) abort(404);

        $posts = $user->posts()->orderBy('created_at', 'desc')->get();

        return view('user.profile', ['user' => $user, 'posts' => $posts]);
    })->name('profile');

});



