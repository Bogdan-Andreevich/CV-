<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use MongoDB\Driver\Session;
use Session\Middleware\AuthenticateSession;


class LogoutController extends Controller
{

    public function logout(Request $request){
        Session::remove('password_hash');
        return redirect('login')->with(Auth::logout());
    }
}
