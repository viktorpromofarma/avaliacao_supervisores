<?php

use App\Http\Middleware\AdminAcess;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Settings\Period;
use App\Http\Controllers\Settings\Categories;
use App\Http\Controllers\Settings\Questions as QuestionsSettings;
use App\Http\Controllers\Settings\Edit\Categories as EditCategories;
use App\Http\Controllers\Admin\Generate_Feedback;
use App\Http\Controllers\Admin\Evaluation_History;
use App\Http\Controllers\Admin\Feedback\ApplyFeedback;
use App\Http\Controllers\Admin\Feedback\Feedback_History;
use App\Http\Controllers\Admin\Feedback\SaveApplyFeedback;
use App\Http\Controllers\Admin\Feedback\ShowFeedbackSupervisor;
use App\Http\Controllers\History\Average\SupervisorAverage;
use App\Http\Controllers\History\Average\SupervisorAverageData;
use App\Http\Controllers\History\FilteredManagerReview;

Route::group(['middleware' => AdminAcess::class], function () {

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
    Route::delete('/settings/questions/{id}', [QuestionsSettings::class, 'destroy'])->name('settings.questions.destroy');

    Route::get('/admin/feedback-history', [Feedback_History::class, 'index'])->name('admin.feedback_history');
    Route::get('/admin/generate-feedback', [Generate_Feedback::class, 'index'])->name('admin.generate_feedback');

    Route::post('/feedback/apply', [ApplyFeedback::class, 'index'])->name('feedback.apply');
    Route::delete('feedback/destroy/{id}', [ApplyFeedback::class, 'destroy'])->name('feedback.destroy');
    Route::post('/feedback/save', [SaveApplyFeedback::class, 'store'])->name('feedback.save');

    Route::post('/feedback/show', [ShowFeedbackSupervisor::class, 'index'])->name('feedback.show');
});
