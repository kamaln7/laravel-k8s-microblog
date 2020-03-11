@extends('layouts.app')

@section('title', 'Login')

@section('header')
<h1 class="mb3">Login</h1>
@endsection

@section('content')

<div class="ph3 pv4">
    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <div class="measure-narrow">
            <div class="mb3">
                @error('username')
                    <p class="orange">{{ $message }}</p>
                @enderror
                <label for="username" class="f6 b db mb2">Username</label>
                <input class="input-reset ba b--black-20 pa2 mb2 db w-100" type="text" name="username" id="username" aria-describedby="username-desc">
                <small id="username-desc" class="f6 lh-copy black-60 db mb2">
                To log in, choose any username you like.
                </small>
            </div>

            <div class="mb3">
                <button type="submit" class="b ph3 pv2 input-reset ba b--black bg-transparent pointer f6 dib">Log in</button>
            </div>
        </div>
    </form>
</div>

@endsection