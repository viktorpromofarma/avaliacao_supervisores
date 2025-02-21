<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeQuestions extends Model
{
    protected $table = 'type_questions_supervisors_assessment';

    protected $fillable = [
        'id',
        'description',
    ];

    public $timestamps = false;
}
