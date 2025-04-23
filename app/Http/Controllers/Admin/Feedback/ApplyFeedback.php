<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Feedback\SupervisorsEvaluationComments;
use App\Models\Category;
use App\Http\Controllers\Basic\UserData;
use App\Models\StatusFeedbackSupervisor;
use App\Models\SaveFeedbackSupervisor;
use App\Models\Question;


class ApplyFeedback extends Controller
{
    public function index(Request $request)
    {



        $userData = $this->getUserData($request->supervisor);
        $classificacoes = $this->getCategory();
        $questoes = $this->getQuestions();
        $comentarios = $this->getCommentary($request->supervisor, $request->month, $request->year);
        $month = $request->month;
        $year = $request->year;



        return view(
            'admin.feedback.applyFeedback',
            [
                'classificacoes' => $classificacoes,
                'questoes' => $questoes,
                'comentarios' => $comentarios,
                'userData' => $userData,
                'month' => $month,
                'year' => $year
            ]
        );
    }

    public function getCommentary($supervisors_id, $month, $year)
    {

        $commentary = new SupervisorsEvaluationComments();

        return $commentary->getCommentary($supervisors_id, $month, $year);
    }

    public function getCategory()
    {
        return Category::pluck('description', 'id')->toArray();
    }

    public function getQuestions()
    {

        return Question::pluck('description', 'id')->toArray();
    }

    public function getUserData($id)
    {
        $user = new UserData();
        return $user->getUserData($id);
    }

    public function destroy($id)
    {

        $status = StatusFeedbackSupervisor::where('id', $id)->get();

        SaveFeedbackSupervisor::where('user_id', $status[0]->user_id)
            ->where('month', $status[0]->month)
            ->where('year', $status[0]->year)->delete();

        StatusFeedbackSupervisor::where('id', $id)->delete();

        return back()->with('success', 'Feedback excluido com sucesso!');
    }
}
