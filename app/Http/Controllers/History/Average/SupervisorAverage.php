<?php

namespace App\Http\Controllers\History\Average;

use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Basic\UserData;


class SupervisorAverage extends Controller
{
    public function index(Request $request)
    {


        $filters = $request->only(['inicial', 'final',  'supervisor']);
        $statusSupervisors = $this->getSupervisorStatus($filters);


        return view('supervisors.average.supervisorAverage', ['statusSupervisors' => $statusSupervisors]);
    }

    public function getUserSupervisor()
    {
        $userData = new UserData();
        return $userData->getSupervisor(Auth::user()->seller);
    }

    public function getSupervisorStatus($filters = [])
    {
        $user = $this->getUserSupervisor();

        $query = StatusUserAnswers::query()
            ->leftJoin('usuarios_avaliacao_supervisao as b', 'status_user_answers.supervisor', '=', 'b.id')
            ->select(
                'status_user_answers.month',
                'status_user_answers.year',
                'status_user_answers.supervisor',
                'b.display_name as name',
                DB::raw("CONVERT(varchar(20), CAST(status_user_answers.created_at AS date), 103) as data_registro")
            )->distinct();



        if (!empty($filters['supervisor'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('b.display_name', 'like', '%' . $filters['supervisor'] . '%')
                    ->orWhere('b.seller', 'like', '%' . $filters['supervisor'] . '%');
            });
        }

        if (!empty($filters['inicial']) && !empty($filters['final'])) {
            $query->where('status_user_answers.created_at', '>=',  date('d/m/Y', strtotime($filters['inicial'])))
                ->where('status_user_answers.created_at', '<=', date('d/m/Y', strtotime($filters['final'])));
        }

        if (empty($filters['month']) && empty($filters['year']) && empty($filters['supervisor'])) {
            $query->where('status_user_answers.month', date('m'))
                ->where('status_user_answers.year', date('Y'));
        }

        if ($user) {
            $query->where('status_user_answers.supervisor', Auth::user()->id);
        }



        return $query->get();
    }
}
