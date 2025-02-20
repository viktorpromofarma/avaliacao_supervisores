<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellersProcfit extends Model
{
    protected $table = 'PBS_PROMOFARMA_DADOS.dbo.VW_FUNCIONARIOS_SUMARIZADO';

    protected $fillable = [
        'nome',
        'matricula'
    ];

    public $timestamps = false;
}
