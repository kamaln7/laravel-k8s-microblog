<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    function showLogin() {
        if (session('username')) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    function login(Request $request) {
        $request->validate([
            'username' => 'required',
        ]);

        $username = $request->input('username');
        session([
            'username' => $username,
        ]);

        return redirect()->route('home')->with('alert', "Logged in as {$username}!");
    }

    function logout() {
        session()->forget('username');

        return redirect()->route('home')->with('alert', 'Logged out.');
    }
}
