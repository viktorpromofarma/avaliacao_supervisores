<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\Period;
use App\Http\Controllers\Data\SaveAnswers;
use App\Http\Controllers\Question\Questions;
use App\Http\Controllers\Settings\Categories;
use App\Http\Controllers\Authentication\FirstAccess;
use App\Http\Controllers\Authentication\CreateAccount;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Settings\Questions as QuestionsSettings;


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
    Route::get('/questions', [Questions::class, '__invoke'])->name('questions');
    Route::post('/save-form', [SaveAnswers::class, 'store'])->name('save-form');


    Route::get('/settings', [Period::class, 'index'])->name('settings.period');
    Route::post('/settings/period', [Period::class, 'store'])->name('settings.period.store');

    Route::get('/settings/categories', [Categories::class, 'index'])->name('settings.categories');
    Route::post('/settings/categories/create', [Categories::class, 'store'])->name('settings.categories.store');

    Route::get('/settings/questions', [QuestionsSettings::class, 'index'])->name('settings.questions');
    Route::post('/settings/questions/create', [QuestionsSettings::class, 'store'])->name('settings.questions.store');
});
