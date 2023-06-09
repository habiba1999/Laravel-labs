<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get("/posts/removeOld",[PostController::class,"removeOldPosts"]);

Route::group(['middleware' =>['auth']], function(){
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    
    Route::post('/posts', [PostController::class,"store"])->name("posts.store");
    
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    
    Route::put('/posts/{post}',[PostController::class , 'update'])->name('posts.update');
    
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
Route::get('/auth/{provider}/redirect',[LoginController::class, 'redirect'])->name('Login');
Route::get('/auth/{provider}/callback',[LoginController::class, 'callback']);

