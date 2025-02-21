<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaveUserAnswers;

class SaveAnswers extends Controller
{
    public function store(Request $request)
    {
        $data = $request->except(['_token', 'username', 'seller']);
        $userData = [
            'username' => $request->username,
            'seller' => $request->seller,
            'created_at' => date('d-m-Y'),
        ];
        try {
            foreach ($data as $question_id => $answer) {
                SaveUserAnswers::create(array_merge($userData, [
                    'question_id' => $question_id,
                    'answer' => $answer,
                ]));
            }
            return redirect(route('home'))->with('success', 'Respostas salvas com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao salvar respostas!');
        }
    }
}
