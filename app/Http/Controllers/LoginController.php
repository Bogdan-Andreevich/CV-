<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    function create()
    {
        return view('authorization.login');
    }

    function store(Request $request) {

        $request->validate([
           'email' => ['required', 'string', 'email'],
           'password' => ['required', 'string']
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
           return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
