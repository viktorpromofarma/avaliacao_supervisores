<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\Period;
use App\Http\Controllers\Data\SaveAnswers;
use App\Http\Controllers\Question\Questions;
use App\Http\Controllers\Settings\Categories;
use App\Http\Controllers\Admin\Feedback_History;
use App\Http\Controllers\Authentication\FirstAccess;
use App\Http\Controllers\Admin\Evaluation_History;
use App\Http\Controllers\Admin\Generate_Feedback;
use App\Http\Controllers\Authentication\CreateAccount;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Settings\Questions as QuestionsSettings;
use App\Http\Controllers\Settings\Edit\Categories as EditCategories;


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
    Route::delete('/settings/period/{id}', [Period::class, 'destroy'])->name('settings.period.destroy');

    Route::get('/settings/categories', [Categories::class, 'index'])->name('settings.categories');
    Route::post('/settings/categories/create', [Categories::class, 'store'])->name('settings.categories.store');
    Route::delete('/settings/categories/{id}', [Categories::class, 'destroy'])->name('settings.categories.destroy');
    Route::get('/settings/categories/{id}', [Categories::class, 'edit'])->name('settings.categories.edit');
    Route::post('/settings/edit/categories', [EditCategories::class, 'update'])->name('settings.categories.update');


    Route::get('/settings/questions', [QuestionsSettings::class, 'index'])->name('settings.questions');
    Route::post('/settings/questions/create', [QuestionsSettings::class, 'store'])->name('settings.questions.store');


    Route::get('/admin/evaluation-history', [Evaluation_History::class, 'index'])->name('admin.evaluation_history');
    Route::get('/admin/feedback-history', [Feedback_History::class, 'index'])->name('admin.feedback_history');
    Route::get('/admin/generate-feedback', [Generate_Feedback::class, 'index'])->name('admin.generate_feedback');
});
