<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveUserAnswers extends Model
{
    protected $table = 'save_user_answers';


    protected $fillable = [
        'id',
        'user_id',
        'question_id',
        'answer_id',
        'answer_text',
        'created_at',
        'store'
    ];

    public $timestamps = false;
}
