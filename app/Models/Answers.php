<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $table = 'answers_supervisors_assessment';

    protected $fillable = [
        'id',
        'description',
        'question_id',
        'note',
        'answer',
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;
}
