<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellersProcfit extends Model
{
    protected $table = 'LG_IMPORTA_FUNCIONARIOS';

    protected $fillable = [
        'nome',
        'matricula'
    ];

    public $timestamps = false;
}
