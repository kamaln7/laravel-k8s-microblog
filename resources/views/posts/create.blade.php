@extends('layouts.app')

@section('title', 'Write a Post')

@section('content')
<h1 class="mb3">Write a Post</h1>

<div class="ph3 pv4">
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="measure">
            <div class="mb3">
                @error('body')
                    <p class="orange">{{ $message }}</p>
                @enderror
                <label for="body" class="f6 b db mb2">Body</label>
                <textarea class="input-reset ba b--black-20 pa2 mb2 db w-100 h4" name="body" id="body" aria-describedby="body-desc"></textarea>
                <small id="body-desc" class="f6 lh-copy black-60 db mb2">
                You are posting as <span class="b">{{ session('username') }}</span>
                </small>
            </div>

            <div class="flex items-center mb3">
                <input class="mr2" type="checkbox" id="attachPhoto" name="attachPhoto" value="true" checked>
                <label for="attachPhoto" class="lh-copy">Attach a random photo</label>
            </div>

            <div class="mb3">
                <button type="submit" class="b ph3 pv2 input-reset ba b--black bg-transparent pointer f6 dib">Save Post</button>
            </div>
        </div>
    </form>
</div>

@endsection