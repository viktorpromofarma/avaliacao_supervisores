<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'period';

    public $timestamps = false;

    protected $fillable = [
        'year',
        'month',
        'start',
        'end',
    ];
}
