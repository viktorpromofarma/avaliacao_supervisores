<?php

namespace App\Http\Controllers\Question;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Answers as AnswersModel;
use App\Http\Controllers\Basic\UserData;
use App\Models\Category as CategoryModel;
use App\Http\Controllers\Verification\StatusAnswers;


class Questions extends Controller
{
    public function __invoke()
    {
        $form_question = $this->getFormQuestions();

        return view('form.questions', ['user' => Auth::user(), 'form_questions' => $form_question]);
    }


    public function getCategories()
    {
        return CategoryModel::all();
    }

    public function getAnswers($questionId)
    {
        return AnswersModel::where('question_id', $questionId)->get();
    }

    public function getFormQuestions()
    {
        $regional = $this->getUserSupervisor(Auth::user()->seller);

        $categories = $this->getCategories();

        $form_question = $categories->map(function ($category) use ($regional) {

            $questions = $category->questions()->where('supervisor_geral_question', $regional ? 1 : 0)->get();


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


    public function getUserSupervisor()
    {
        $statusAnswers = $this->getUserAnswersStatus(Auth::user()->id)->first();

        $regional = new UserData();

        return $regional->getSupervisor(Auth::user()->seller, $statusAnswers->LOJA);
    }

    public function getUserAnswersStatus($user_id)
    {
        return (new StatusAnswers())->getUserAnswersStatus($user_id);
    }
}
