@extends('layouts.app')

@section('title', 'Home')

@section('content')
<h1 class="mb4">Posts</h1>

@forelse($posts as $post)
<div class="pa2 mb3 striped--near-white">
    <header class="b mb2">{{ $post->author }}</header>
    <div class="pl2">
        <p class="mb2">{{ $post->body }}</p>
    </div>
</div>
@empty
<p>There are no posts on this micro-blog yet :(</p>
@endforelse

@endsection