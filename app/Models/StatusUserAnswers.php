<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusUserAnswers extends Model
{
    protected $table = 'status_user_answers';

    protected $fillable = [
        'user_id',
        'supervisor',
        'month',
        'store',
        'year',
        'created_at',
    ];

    public $timestamps = false;
}
