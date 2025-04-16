<?php


use App\Http\Middleware\ManagerAcess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Data\SaveAnswers;
use App\Http\Controllers\Question\Questions;
use App\Http\Controllers\Admin\Evaluation_History;
use App\Http\Controllers\History\FilteredManagerReview;


Route::group(['middleware' => [ManagerAcess::class]], function () {

    Route::get('/questions', [Questions::class, '__invoke'])->name('questions');


    Route::post('/save-answers', [SaveAnswers::class, 'store'])->name('save-answers');
});
