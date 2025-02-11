<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Authentication\FirstAccess;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\CreateAccount;


Route::get('/login', function () {
    if (Session::has('username')) {
        return redirect()->route('home');
    }
    return view('authentication.login');
})->name('login');

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/first-access/{id}', [FirstAccess::class, '__invoke'])->name('first-access');

Route::post('/create-account', [CreateAccount::class, 'store'])->name('create-account');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [loginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
