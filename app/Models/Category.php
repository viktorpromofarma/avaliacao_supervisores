<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category_questions_supervisors_assessment';

    public $timestamps = false;

    protected $fillable = [
        'description',
    ];
}
