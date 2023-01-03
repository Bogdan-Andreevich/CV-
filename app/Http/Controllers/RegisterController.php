<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class RegisterController extends Controller
{

    function create()
    {
        return view('authorization.register');
    }

    function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);
        if (isset($validator)){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]);
            Auth::login($user);
            return redirect('/dashboard');
        }
    }
}
