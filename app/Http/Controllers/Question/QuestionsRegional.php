<?php

namespace App\Http\Controllers\Question;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Question\Questions;
use Illuminate\Support\Facades\Auth;

class QuestionsRegional extends Controller
{
    public function __invoke()
    {
        $supervisorInfo = $this->getSupervisor();

        $form_question = $this->getFormQuestions();


        return view('form.questions-regional', ['user' => Auth::user(), 'form_questions' => $form_question, 'supervisorInfo' => $supervisorInfo]);
    }


    public function getCategories()
    {
        return (new Questions())->getCategories();
    }

    public function getAnswers($questionId)
    {
        return (new Questions())->getAnswers($questionId);
    }

    public function getFormQuestions()
    {


        $categories = $this->getCategories();

        $form_question = $categories->map(function ($category) {

            $questions = $category->questions()->where('supervisor_geral_question', 'S')->get();


            if ($questions->isEmpty()) {
                return null;
            }

            $questions = $questions->map(function ($question) {
                $answers = $this->getAnswers($question->id);
                return [
                    'id' => $question->id,
                    'questao' => $question->description,
                    'tipo' => $question->type ? $question->type->description : 'Não especificado',
                    'respostas' => $answers ? $answers->map(function ($answer) {
                        return [
                            'id' => $answer->id,
                            'resposta' => $answer->description
                        ];
                    }) : [],
                ];
            });

            return [
                'categoria' => $category->description,
                'questoes' => $questions
            ];
        });


        $form_question = $form_question->filter(function ($item) {
            return $item !== null;
        });

        return $form_question;
    }


    public function getSupervisor()
    {

        $supervisorInfo = User::query()
            ->join('access_roles as b', function ($join) {
                $join->on('usuarios_avaliacao_supervisao.id', '=', 'b.user_id');
            })
            ->select('usuarios_avaliacao_supervisao.id', 'display_name as NOME_SUPERVISOR', DB::raw('990 AS LOJA'))
            ->where('b.supervisor', 1)
            ->first();

        return $supervisorInfo;
    }
}
