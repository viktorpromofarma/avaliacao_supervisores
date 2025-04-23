<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions_supervisors_assessment';

    protected $fillable = [
        'id',
        'description',
        'type_id',
        'supervisor_geral_question',
        'category_id',
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function answers()
    {
        return $this->hasMany(Answers::class, 'question_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeQuestions::class, 'type_id');
    }




    public $timestamps = false;
}
