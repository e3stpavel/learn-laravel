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
Route::resource('/admin/posts', \App\Http\Controllers\PostController::class);

//Route::get('/posts/{name}/{id?}', [\App\Http\Controllers\HomeController::class, 'routeParameter'])->where('id', '[0-9]+');
//Route::get('/posts/bru/1', [\App\Http\Controllers\HomeController::class, 'someother'])->where('id', '[0-9]+');
