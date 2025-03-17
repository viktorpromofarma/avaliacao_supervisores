<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusFeedbackSupervisor extends Model
{
    protected $table = 'status_supervisor_feedback';


    protected $fillable = [
        'user_id',
        'month',
        'year',
        'created_at',
    ];

    public $timestamps = false;
}
