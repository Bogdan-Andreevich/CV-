<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;


class MainPageController extends Controller
{

    function create()
    {
        return view('test');
    }

    function store(Request $request){

    }
}
