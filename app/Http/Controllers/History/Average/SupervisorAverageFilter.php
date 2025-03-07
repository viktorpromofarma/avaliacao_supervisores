<?php

namespace App\Http\Controllers\History\Average;

use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Basic\UserData;

class SupervisorAverageFilter extends Controller
{
    public function getSupervisorAverageFilter(Request $request)
    {
        $baseSupervisorAverage = $this->getSupervisorAverage($request->supervisor, $request->month, $request->year);
        $averageByCategory = $this->getAverageByCategory($baseSupervisorAverage);

        return $averageByCategory;
    }

    public function getSupervisorAverage($supervisor = null, $month = null, $year = null)
    {


        $query = StatusUserAnswers::query()
            ->join('SAVE_USER_ANSWERS as b', function ($join) {
                $join->on('status_user_answers.month', '=', DB::raw('month(B.CREATED_AT)'))
                    ->on('status_user_answers.year', '=',  DB::raw('year(B.CREATED_AT)'))
                    ->on('status_user_answers.user_id', '=', 'b.user_id')
                    ->whereNotNull('b.answer_id');
            })
            ->join('ANSWERS_SUPERVISORS_ASSESSMENT as c', 'b.answer_id', '=', 'c.id')
            ->join('questions_supervisors_assessment as d', 'b.question_id', '=', 'd.id')
            ->join('category_questions_supervisors_assessment as e', 'd.category_id', '=', 'e.id')
            ->select(
                'status_user_answers.SUPERVISOR',
                'status_user_answers.MONTH',
                'status_user_answers.YEAR',
                'status_user_answers.USER_ID',
                'E.ID AS CATEGORY',
                'E.DESCRIPTION AS CATEGORY_DESCRIPTION',
                'B.QUESTION_ID',
                'D.DESCRIPTION AS QUESTION_DESCRIPTION',
                'C.NOTE'
            )->where('status_user_answers.SUPERVISOR', $supervisor)
            ->where('status_user_answers.MONTH', $month)
            ->where('status_user_answers.YEAR', $year);

        return $query->get();
    }

    public function getAverageByCategory($data)
    {
        $groupedData = $data->groupBy(function ($item) {
            return  $item->CATEGORY_DESCRIPTION;
        });
        $averageByCategory = $groupedData->map(function ($group) {
            return [
                'CATEGORY_DESCRIPTION' => $group->first()->CATEGORY_DESCRIPTION,
                'AVERAGE_NOTE' => number_format($group->avg('NOTE'), 2, '.', '')
            ];
        });

        return $averageByCategory->values();
    }
}
