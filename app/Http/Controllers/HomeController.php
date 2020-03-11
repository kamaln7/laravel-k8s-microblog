<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Post;

class HomeController extends Controller
{
    function index() {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
