<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaveFeedbackSupervisor extends Model
{
    protected $table = 'save_supervisor_feedback';

    protected $fillable = [
        'user_id',
        'answer_id',
        'category_id',
        'month',
        'year',
        'commentAdd',
        'positivePoints',
        'pointsToImprove',
        'recomendation',
        'conclusion',
        'created_at',
    ];

    public $timestamps = false;
}
