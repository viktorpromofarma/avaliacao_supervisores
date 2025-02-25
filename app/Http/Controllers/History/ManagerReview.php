<?php

namespace App\Http\Controllers\History;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\History\Reviews;

class ManagerReview extends Reviews
{
    public function getBaseReview($id, $month, $year)
    {
        $categories = $this->getCategories();
        $questions = $this->getQuestions();
        $answers = $this->getAnswers();

        $userAnswers = $this->getSaveUserAnswers()
            ->where('user_id', $id)
            ->where('month', $month)
            ->where('year', $year);


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
                    $userAnswersForQuestion = $userAnswers->where('question_id', $question->id);
                    foreach ($userAnswersForQuestion as $userAnswer) {
                        $answerText = $userAnswer->answer_text;
                        $answerId = $userAnswer->answer_id;
                        $answer = $answerId !== null ? $answers->find($answerId)->description : $answerText;
                        if ($answer) {
                            $questionData['answers'][] = [
                                'answer' => $answer,
                                'user_id' => $userAnswer->user_id,
                                'created_at' => $userAnswer->created_at
                            ];
                        }
                    }
                    $categoryData['questions'][] = $questionData;
                }
            }
            $result[] = $categoryData;
        }
        return $result;
    }
}
