<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Root;
use App\Http\Controllers\User\Security\ResetPassword;


Route::group(['middleware' => [Root::class]], function () {

    Route::get('/user/reset', [ResetPassword::class, 'index'])->name('user.reset');
    Route::post('/user/reset/password', [ResetPassword::class, 'updatePassword'])->name('user.reset.password');
});
