<?php

namespace App\Http\Controllers\Data;

use App\Models\User;
use App\Models\Sellers;
use Illuminate\Http\Request;
use App\Models\SaveUserAnswers;
use App\Models\StatusUserAnswers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\History\Reviews;

class SaveAnswers extends Controller
{
    public function store(Request $request)
    {
        $categories = $this->getQuestionsCategories();
        $data = $request->except(['_token', 'user_id']);

        $userData = [
            'user_id' => $request->user_id,
            'created_at' => date('d-m-Y'),
        ];

        try {

            foreach ($data as $question_id => $answer) {
                $this->saveAnswer($categories, $question_id, $answer, $userData);
            }
            $this->saveStatusUserAnswers($request->user_id);


            return redirect(route('home'))->with('success', 'Respostas salvas com sucesso!');
        } catch (\Throwable $th) {

            return back()->with('error', 'Erro ao salvar respostas!');
        }
    }

    private function saveAnswer($categories, $question_id, $answer, $userData)
    {

        $question = collect($categories)->firstWhere('id', $question_id);

        if ($question) {
            $answerData = [
                'question_id' => $question_id,
                'created_at' => date('d-m-Y'),
            ];


            if ($question['type_description'] == 'Múltipla Escolha') {

                try {
                    SaveUserAnswers::create(array_merge($userData, $answerData, [
                        'answer_id' => $answer,
                        'answer_text' => null,
                    ]));
                } catch (\Throwable $th) {
                    return back()->with('error', 'Erro ao salvar respostas!');
                }
            } else {

                try {
                    SaveUserAnswers::create(array_merge($userData, $answerData, [
                        'answer_id' => null,
                        'answer_text' => $answer,
                    ]));
                } catch (\Throwable $th) {
                    return back()->with('error', 'Erro ao salvar respostas!');
                }
            }
        }
    }

    private function saveStatusUserAnswers($user_id)
    {
        $seller = $this->getSupervisor($user_id);
        $supervisor = User::where('seller', $seller->SUPERVISOR)->first();

        StatusUserAnswers::create([
            'user_id' => $user_id,
            'supervisor' =>  $supervisor->id,
            'store' => $seller->LOJA,
            'month' => now()->format('m'),
            'year' => now()->format('Y'),
            'created_at' => date('d-m-Y'),
        ]);
    }

    public function getSupervisor($user_id)
    {
        $seller = User::where('id', $user_id)->first();
        return Sellers::where('gerente_atual', $seller->seller)->first();
    }


    public function getQuestionsCategories()
    {
        $reviews = new Reviews();
        $typeQuestions = $reviews->getTypeQuestions();
        $questions = $reviews->getQuestions();


        foreach ($questions as &$question) {
            foreach ($typeQuestions as $type) {
                if ($question['type_id'] == $type['id']) {
                    $question['type_description'] = $type['description'];
                    break;
                }
            }
        }

        return $questions;
    }
}
