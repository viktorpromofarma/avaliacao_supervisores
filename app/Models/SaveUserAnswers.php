<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveUserAnswers extends Model
{
    protected $table = 'save_user_answers';


    protected $fillable = [
        'id',
        'username',
        'seller',
        'question_id',
        'answer',
        'created_at',
    ];

    public $timestamps = false;
}
