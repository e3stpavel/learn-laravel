<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function show(User $user) {
        //dd($user);
        $posts = $user->posts()->paginate();

        return response()->view('user_showcase', compact('user', 'posts'));
    }

    #TODO show how many likes user got
}
