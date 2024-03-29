<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () {
        return view('index');
    });

    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

    Route::get('logout', [LogoutController::class, 'logout'])->middleware('auth');


    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    Route::get('/email/verify', function () {
        return view('authorization.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('dashboard', [MainPageController::class, 'create'])->middleware(['auth', 'verified']);


