<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Answers;
use App\Models\Category as CategoryModel;
use App\Models\Question as QuestionModel;
use App\Models\TypeQuestions;
use Illuminate\Http\Request;

class Questions extends Controller
{
    public function index()
    {

        $categories = $this->getCategories();

        $typeQuestions = $this->getTypesQuestions();

        $questions = $this->getQuestions();



        return view(
            'settings.questions',
            [
                'categories' => $categories,
                'typeQuestions' => $typeQuestions,
                'questions' => $questions
            ]
        );
    }

    public function store(Request $request)
    {

        try {
            $question = QuestionModel::create([
                'description' => $request->description,
                'category_id' => $request->category,
                'type_id' => $request->type_question,
                'supervisor_geral_question' => $request->generalSupervisor,
                'created_at' => date('d-m-Y'),
                'active' => 'S'
            ]);
            try {
                foreach ($request->respostas as $index => $resposta) {
                    Answers::create([
                        'description' => $resposta,
                        'note' => $request->notas[$index],
                        'question_id' => $question->id,
                        'created_at' => date('d-m-Y'),
                    ]);
                }
            } catch (\Throwable $th) {
                return back()->with('success', 'Questão cadastrada com sucesso!');
            }
            return back()->with('success', 'Questão cadastrada com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao cadastrar questão!');
        }
    }

    public function getCategories()
    {
        return CategoryModel::query()->where('active', 'S')->get();
    }

    public function getTypesQuestions()
    {
        return TypeQuestions::all();
    }

    public function getQuestions()
    {

        $questions = QuestionModel::with(['type', 'category'])
            ->where('active', 'S')
            ->orderBy('category_id', 'asc')
            ->get();

        $questionsWithDescriptions = $questions->map(function ($question) {

            $question->type_description = $question->type->description;


            $question->category_description = $question->category->description;


            return $question;
        });

        return $questionsWithDescriptions;
    }

    public function destroy($id)
    {

        try {
            QuestionModel::where('id', $id)->update([
                'active' => 'N'
            ]);
            return back()->with('success', 'Questão excluida com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao excluir questão!');
        }
    }
}
