<?php


use Illuminate\Support\Facades\Route;
use App\Http\Middleware\SupervisorAcess;
use App\Http\Controllers\Admin\Feedback\Feedback_History;
use App\Http\Controllers\History\Average\SupervisorAverage;
use App\Http\Controllers\Admin\Feedback\ShowFeedbackSupervisor;
use App\Http\Controllers\History\Average\SupervisorAverageData;


Route::group(['middleware' => [SupervisorAcess::class]], function () {});
