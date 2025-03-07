<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;
use App\Models\Period;


class StatusAnswers extends Controller
{

    public function getUserAnswersStatus($user_id)
    {

        return StatusUserAnswers::query()
            ->join('period', function ($join) {
                $join->on('status_user_answers.month', '=', 'period.month')
                    ->on('status_user_answers.year', '=', 'period.year');
            })
            ->where('user_id', $user_id)
            ->Exists();
    }

    public function getPeriod()
    {
        return Period::all();
    }
}
