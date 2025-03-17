<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatusFeedbackSupervisor;
use App\Http\Controllers\Basic\UserData;
use Illuminate\Support\Facades\Auth;

class Feedback_History extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['month', 'year',  'supervisor']);
        $feedbacks = $this->listFeedbacks($filters);


        return view('admin.feedback_history', ['feedbacks' => $feedbacks]);
    }

    public function getUserSupervisor()
    {
        $userData = new UserData();
        return $userData->getSupervisor(Auth::user()->seller);
    }

    public function listFeedbacks($filters = [])
    {

        $user = $this->getUserSupervisor();


        $query = StatusFeedbackSupervisor::query()
            ->leftJoin('usuarios_avaliacao_supervisao as users', 'users.id', '=', 'status_supervisor_feedback.user_id')
            ->select(
                'users.display_name as display_name',
                'users.seller as seller',
                'status_supervisor_feedback.id',
                'status_supervisor_feedback.month',
                'status_supervisor_feedback.year',
                'status_supervisor_feedback.created_at'

            );



        if (!empty($filters['month'])) {
            $query->where('status_supervisor_feedback.month', $filters['month']);
        }

        if (!empty($filters['year'])) {
            $query->where('status_supervisor_feedback.year', $filters['year']);
        }

        if (!empty($filters['supervisor'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('users.display_name', 'like', '%' . $filters['supervisor'] . '%')
                    ->orWhere('users.seller', 'like', '%' . $filters['supervisor'] . '%');
            });
        }

        if ($user) {
            $query->where('users.seller ', Auth::user()->seller);
        }

        $query->orderBy('status_supervisor_feedback.created_at', 'desc');

        return $query->get();
    }
}
