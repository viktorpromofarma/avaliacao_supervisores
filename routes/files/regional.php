<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RegionalAcess;
use App\Http\Controllers\Admin\Evaluation_History;
use App\Http\Controllers\Data\SaveAnswersRegional;
use App\Http\Controllers\Question\QuestionsRegional;
use App\Http\Controllers\Admin\Feedback\Feedback_History;
use App\Http\Controllers\History\Average\SupervisorAverage;
use App\Http\Controllers\History\Average\SupervisorAverageData;


Route::group(['middleware' => [RegionalAcess::class]], function () {



    Route::get('/admin/evaluation-history', [Evaluation_History::class, 'index'])->name('admin.evaluation_history');


    Route::get('/questionsRegional', [QuestionsRegional::class, '__invoke'])->name('questionsRegional');
    Route::post('/save-answers-regional', [SaveAnswersRegional::class, 'store'])->name('save-answers-regional');
});
