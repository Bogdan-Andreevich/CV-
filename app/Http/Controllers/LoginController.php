<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class LoginController extends Controller
{

    function create()
    {
        return view('authorization.login');
    }

    function store(Request $request){

        $validator = $request->only([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::check()){
            return redirect()->intended('dashboard');
        }
        if (Auth::attempt($validator)) {

            $request->session()->regenerate();
            return response()->json([
                "token"=>csrf_token()],
                200);

            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
           'email' => 'The provided credentials do not match our records.',
        ]);

    }
}
