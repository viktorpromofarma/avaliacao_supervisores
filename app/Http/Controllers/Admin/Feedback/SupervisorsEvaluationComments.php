<?php

namespace App\Http\Controllers\Admin\Feedback;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\StatusUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SupervisorsEvaluationComments extends Controller
{
    public function getCommentary($id_supervisor)
    {
        $categorias = $this->getCategory()->keyBy('id');

        return $this->getCommentaryEvaluation($id_supervisor)->map(function ($comentario) use ($categorias) {
            return [
                'id' => $comentario->answer_id,
                'comentario' => $comentario->commentary,
                'classificacao_id' => $comentario->category_id,
                'classificacao' => $categorias[$comentario->category_id]->description ?? 'Sem classificação'
            ];
        });
    }


    public function getCategory()
    {

        return Category::query()
            ->select('id', 'description')
            ->get();
    }


    public function getCommentaryEvaluation($id_supervisor)
    {

        return StatusUserAnswers::query()
            ->leftJoin('save_user_answers as b', function ($join) {
                $join->on('status_user_answers.user_id', '=', 'b.user_id')
                    ->on('status_user_answers.month', '=', DB::raw('month(b.created_at)'))
                    ->on('status_user_answers.year', '=', DB::raw('year(b.created_at)'))
                    ->on('status_user_answers.store', '=', 'b.store')
                    ->whereNotNull('b.answer_text');
            })
            ->leftJoin('questions_supervisors_assessment as c', 'b.question_id', '=', 'c.id')
            ->leftJoin('category_questions_supervisors_assessment as d', 'c.category_id', '=', 'd.id')
            ->where('status_user_answers.supervisor', $id_supervisor)
            ->select(
                'd.id as category_id',
                'd.description',
                'b.id as answer_id',
                'b.answer_text as commentary'
            )

            ->get();
    }
}
