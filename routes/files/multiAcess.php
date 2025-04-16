<?php

use App\Http\Middleware\MultiAcess;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Evaluation_History;
use App\Http\Controllers\History\FilteredManagerReview;
use App\Http\Controllers\Admin\Feedback\Feedback_History;
use App\Http\Controllers\History\Average\SupervisorAverage;
use App\Http\Controllers\Admin\Feedback\ShowFeedbackSupervisor;
use App\Http\Controllers\History\Average\SupervisorAverageData;

Route::group(['middleware' => [MultiAcess::class]], function () {


    Route::get('/admin/evaluation-history', [Evaluation_History::class, 'index'])->name('admin.evaluation_history');
    Route::post('/reviews/manager', [FilteredManagerReview::class, 'index'])->name('reviews.my-reviews');
    Route::get('/admin/feedback-history', [Feedback_History::class, 'index'])->name('admin.feedback_history');
    Route::post('/feedback/show', [ShowFeedbackSupervisor::class, 'index'])->name('feedback.show');
    Route::get('/average/supervisor', [SupervisorAverage::class, 'index'])->name('average.supervisor');
    Route::post('/average/supervisor/filter', [SupervisorAverageData::class, 'index'])->name('average.supervisor_filter');
});
