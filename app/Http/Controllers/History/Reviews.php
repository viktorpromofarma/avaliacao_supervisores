<?php

namespace App\Http\Controllers\History;

use App\Models\User;
use App\Models\Answers;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\TypeQuestions;
use App\Models\SaveUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Reviews extends Controller
{

    public function getCategories()
    {
        return Category::all();
    }

    public function getSaveUserAnswers()
    {
        return SaveUserAnswers::query()
            ->select(
                'id',
                'user_id',
                'question_id',
                'answer_id',
                'answer_text',
                'created_at',
                DB::raw('DATEPART(MONTH, created_at) AS month'),
                DB::raw('DATEPART(YEAR, created_at) AS year')
            )
            ->get();
    }

    public function getQuestions()
    {
        return Question::all();
    }

    public function getAnswers()
    {
        return Answers::all();
    }

    public function getTypeQuestions()
    {
        return TypeQuestions::all();
    }
}
