<?php

namespace App\Http\Controllers\History;

use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Capsule\Manager;
use App\Http\Controllers\History\ManagerReview;

class FilteredManagerReview extends ManagerReview
{
    public function index(Request $request)
    {
        $userData = $this->getReviewUsersData($request);

        $review = $this->getReview($request);



        return view('reviews.review', [
            'reviews' => $review,
            'userDatas' => $userData
        ]);
    }

    public function getReview($request)
    {
        extract($this->getRequestParameters($request));

        $baseReview = $this->getBaseReview($id, $month, $year);

        return $baseReview;
    }

    public function getReviewUsersData($request)
    {
        extract($this->getRequestParameters($request));

        return StatusUserAnswers::query()
            ->leftJoin('usuarios_avaliacao_supervisao as b', 'status_user_answers.user_id', '=', 'b.id')
            ->leftJoin('usuarios_avaliacao_supervisao as c', 'status_user_answers.supervisor', '=', 'c.id')
            ->select(
                'status_user_answers.month',
                'status_user_answers.year',
                'status_user_answers.store',
                'status_user_answers.user_id',
                'status_user_answers.supervisor',
                DB::raw("CONVERT(varchar(20), CAST(status_user_answers.created_at AS date), 103) as data_registro"),
                'status_user_answers.id',
                'b.display_name as manager_name',
                'b.seller as manager_seller',
                'c.display_name as supervisor_name',
                'c.seller as supervisor_register'
            )->where('status_user_answers.month', $month)
            ->where('status_user_answers.year', $year)
            ->where('status_user_answers.user_id', $id)->first();
    }

    private function getRequestParameters($request)
    {
        return [
            'id' => $request->user_id,
            'month' => $request->month,
            'year' => $request->year,
        ];
    }
}
