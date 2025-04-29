<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Authentication\FirstAccess;
use App\Http\Controllers\Authentication\CreateAccount;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\User\Security\Profile;

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
    Route::get('/logout', [loginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/user/profile', [Profile::class, 'index'])->name('user.profile');
    Route::post('/user/profile/update', [Profile::class, 'updateUser'])->name('user.profile.update');

    require __DIR__ . '/files/admin.php';
    require __DIR__ . '/files/manager.php';
    require __DIR__ . '/files/regional.php';
    require __DIR__ . '/files/supervisor.php';
    require __DIR__ . '/files/multiAcess.php';
    require __DIR__ . '/files/root.php';
});
