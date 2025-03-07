<?php

namespace App\Http\Controllers\History\Average;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;


class SupervisorAverage extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['month', 'year',  'supervisor']);
        $statusSupervisors = $this->getSupervisorStatus($filters);

        return view('supervisors.average.supervisorAverage', ['statusSupervisors' => $statusSupervisors]);
    }

    public function getSupervisorStatus($filters = [])
    {

        $query = StatusUserAnswers::query()
            ->leftJoin('usuarios_avaliacao_supervisao as b', 'status_user_answers.supervisor', '=', 'b.id')
            ->select(
                'status_user_answers.month',
                'status_user_answers.year',
                'status_user_answers.supervisor',
                'b.display_name as name',
            )->distinct();

        // Aplica os filtros de forma condicional
        if (!empty($filters['month'])) {
            $query->where('status_user_answers.month', $filters['month']);
        }

        if (!empty($filters['year'])) {
            $query->where('status_user_answers.year', $filters['year']);
        }

        if (!empty($filters['supervisor'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('b.display_name', 'like', '%' . $filters['supervisor'] . '%')
                    ->orWhere('b.seller', 'like', '%' . $filters['supervisor'] . '%');
            });
        }

        return $query->get();
    }
}
