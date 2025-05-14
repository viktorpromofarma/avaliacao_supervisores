<?php

namespace App\Http\Controllers\Data;


use Illuminate\Http\Request;
use App\Models\SaveUserAnswers;
use App\Models\StatusUserAnswers;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Data\SaveAnswers;


class SaveAnswersRegional extends Controller
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
                $this->saveAnswer($categories, $question_id, $answer, $userData, $request->store);
            }
            $this->saveStatusUserAnswers($request->user_id, $request->store, $request->supervisor_id);
            return redirect(route('home'))->with('success', 'Respostas salvas com sucesso!');
        } catch (\Throwable $th) {

            return back()->with('error', 'Erro ao salvar respostas!');
        }
    }


    public function getQuestionsCategories()
    {

        return (new SaveAnswers())->getQuestionsCategories();
    }


    public function saveAnswer($categories, $question_id, $answer, $userData, $store)
    {
        $question = collect($categories)->firstWhere('id', $question_id);

        if ($question) {
            $answerData = [
                'question_id' => $question_id,
                'created_at' => date('d-m-Y'),
            ];
            if ($question['type_description'] == 'Múltipla Escolha') {
                try {

                    SaveUserAnswers::UpdateOrCreate(array_merge($userData, $answerData, [
                        'answer_id' => $answer,
                        'answer_text' => null,
                        'store' => $store
                    ]));
                } catch (\Throwable $th) {
                    return back()->with('error', 'Erro ao salvar respostas!');
                }
            } else {
                try {
                    SaveUserAnswers::UpdateOrCreate(array_merge($userData, $answerData, [
                        'answer_id' => null,
                        'answer_text' => $answer,
                        'store' => $store
                    ]));
                } catch (\Throwable $th) {

                    return back()->with('error', 'Erro ao salvar respostas!');
                }
            }
        }
    }

    private function saveStatusUserAnswers($user_id, $store, $supervisor)
    {

        StatusUserAnswers::UpdateOrCreate([
            'user_id' => $user_id,
            'supervisor' => $supervisor,
            'store' => $store,
            'month' => now()->format('m'),
            'year' => now()->format('Y'),
            'created_at' => now()->format('d-m-Y'),
        ]);
    }
}
