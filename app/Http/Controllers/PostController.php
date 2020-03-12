<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Jobs\AttachPhotoToPost;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $body = $request->input('body');
        $post = Post::create([
            'author' => session('username'),
            'body' => $body,
        ]);

        $alert = 'Post created!';
        if ($request->boolean('attachPhoto')) {
            AttachPhotoToPost::dispatch($post);
            $alert .= ' Photo attachment scheduled, check in a couple of seconds.';
        }

        return redirect()->route('home')->with('alert', $alert);
    }
}
