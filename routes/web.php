<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/posts', [\App\Http\Controllers\HomeController::class, 'posts']);
Route::get('/posts/{post}', [\App\Http\Controllers\HomeController::class, 'post'])->whereNumber('post')->name('post');

Route::get('/tag/{tag}', [\App\Http\Controllers\HomeController::class, 'tag']);

Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('show_user_by_id');

/*
Route::get('/admin/posts', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('/admin/posts/create', [\App\Http\Controllers\PostController::class, 'create']);
Route::post('/admin/posts', [\App\Http\Controllers\PostController::class, 'store']);
Route::get('/admin/posts/{post}/edit', [\App\Http\Controllers\PostController::class, 'edit']);
Route::post('/admin/posts/{post}', [\App\Http\Controllers\PostController::class, 'update']);
Route::get('/admin/posts/{post}/delete', [\App\Http\Controllers\PostController::class, 'destroy']);
Route::get('/admin/posts/{post}', [\App\Http\Controllers\PostController::class, 'show']);
*/

//Route::get('/posts/{name}/{id?}', [\App\Http\Controllers\HomeController::class, 'routeParameter'])->where('id', '[0-9]+');
//Route::get('/posts/bru/1', [\App\Http\Controllers\HomeController::class, 'someother'])->where('id', '[0-9]+');

Route::middleware(['auth'])->group(function() {
    Route::get('/home', function() {
        return view('home');
    })->name('home');

    Route::resource('admin/posts', \App\Http\Controllers\PostController::class);

    Route::post('post/{post}', [\App\Http\Controllers\CommentController::class, 'store']);

    Route::get('post/{post}/like', [\App\Http\Controllers\LikeController::class, 'postLike'])->name('post.like');
    Route::get('post/comment/like', [\App\Http\Controllers\LikeController::class, 'commentLike'])->name('comment.like');

    Route::get('/user/profile', function() {
        return view('profile');
    })->name('profile');
});
