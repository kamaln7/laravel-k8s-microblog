@extends('layouts.app')

@section('title', 'Home')

@section('header')
<h1 class="mb4">Posts</h1>
@endsection

@section('content')

<div class="mb3">
    <a class="link f5 black dim b" href="{{ route('posts.create') }}">✍️ Write a Post</a>
</div>

<div>
@forelse($posts as $post)
<div class="ph3 pv4 striped--near-white flex">
    <div class="flex-grow-1 mr2">
        <header class="mb2"><span class="b pr2">{{ $post->author }}</span> {{ $post->created_at->diffForHumans() }}</header>
        <div class="pl2">
            <p class="mb2">{{ $post->body }}</p>
        </div>
    </div>
    <div class="flex-shrink-0">
        @if($post->photo)
            <img src="{{ Storage::url($post->photoFilename()) }}" style="width: 96px" class="br-100 pa1 ba b--black-10">
        @endif
    </div>
</div>
@empty
<p>There are no posts on this micro-blog yet :(</p>
@endforelse
</div>

@endsection