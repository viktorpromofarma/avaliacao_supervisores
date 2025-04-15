<?php

namespace App\Http\Controllers\History;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\History\Reviews;

class ManagerReview extends Reviews
{
    public function getBaseReview($id, $month, $year, $store)
    {
        $categories = $this->getCategories();
        $questions = $this->getQuestions();
        $answers = $this->getAnswers();


        $userAnswers = $this->getSaveUserAnswers()
            ->where('user_id', $id)
            ->where('month', $month)
            ->where('year', $year)
            ->where('store', $store);

        $result = [];

        foreach ($categories as $category) {
            $categoryData = [
                'category_id' => $category->id,
                'category_description' => $category->description,
                'questions' => []
            ];

            foreach ($questions as $question) {
                if ($question->category_id == $category->id) {
                    $questionData = [
                        'question_id' => $question->id,
                        'question_description' => $question->description,
                        'answers' => []
                    ];

                    // Obter as respostas do usuário para a questão
                    $userAnswersForQuestion = $userAnswers->where('question_id', $question->id);

                    // Verificar se há respostas
                    foreach ($userAnswersForQuestion as $userAnswer) {
                        $answerText = $userAnswer->answer_text;
                        $answerId = $userAnswer->answer_id;
                        $answer = $answerId !== null ? $answers->find($answerId)->description : $answerText;

                        // Se a resposta for válida, adicionar à lista de respostas da questão
                        if ($answer) {
                            $questionData['answers'][] = [
                                'answer' => $answer,
                                'user_id' => $userAnswer->user_id,
                                'created_at' => $userAnswer->created_at
                            ];
                        }
                    }

                    // Adicionar a questão ao array da categoria apenas se tiver respostas
                    if (count($questionData['answers']) > 0) {
                        $categoryData['questions'][] = $questionData;
                    }
                }
            }

            // Adicionar a categoria ao resultado se tiver questões com respostas
            if (count($categoryData['questions']) > 0) {
                $result[] = $categoryData;
            }
        }

        return $result;
    }
}
