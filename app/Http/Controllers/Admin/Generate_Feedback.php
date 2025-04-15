<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatusUserAnswers;
use Termwind\Components\Dd;

class Generate_Feedback extends Controller
{
    public function index()
    {
        $supervisors = $this->getStatusSupervisor()->get();

        return view('admin.generate_feedback', ['supervisors' => $supervisors]);
    }

    public function getStatusSupervisor()
    {
        return StatusUserAnswers::query()
            ->leftJoin('usuarios_avaliacao_supervisao as b', 'status_user_answers.supervisor', '=', 'b.id')
            ->leftjoin('status_supervisor_feedback as c', function ($join) {
                $join->on('status_user_answers.month', '=', 'c.month')
                    ->on('status_user_answers.year', '=', 'c.year')
                    ->on('status_user_answers.supervisor', '=', 'c.user_id');
            })
            ->select(
                'status_user_answers.month',
                'status_user_answers.year',
                'status_user_answers.supervisor',
                'b.display_name as supervisor_name',
                'c.id as feedback_id'
            )->distinct()
            ->orderBy('status_user_answers.month', 'asc')
            ->orderBy('status_user_answers.year', 'asc');
    }
}
