<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Question as QuestionModel;
use App\Models\Category as CategoryModel;
use App\Models\Answers as AnswersModel;
use App\Models\StatusUserAnswers;
use App\Models\Period;

class Questions extends Controller
{
    public function __invoke()
    {
        $form_question = $this->getFormQuestions();

        return view('form.questions', ['user' => Auth::user(), 'form_questions' => $form_question]);
    }

    public function getQuestions()
    {
        return QuestionModel::all();
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

        $categories = $this->getCategories();
        $form_question = $categories->map(function ($category) {
            $questions = $category->questions->map(function ($question) {
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
        return $form_question;
    }
}
