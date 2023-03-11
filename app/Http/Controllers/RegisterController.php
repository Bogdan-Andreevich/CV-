<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{

    function create(){

        return view('authorization.register');
    }

    function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if (User::where('email', $request->email)->exists()){
            return redirect('/login')->withErrors([
                'email' => 'A user with this email already exists.',
            ]);
        }
//        if (isset($validator)){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,

            ]);
            event(new Registered($user));

            Auth::login($user);
            return redirect('/email/verify');
//        }
    }
}
