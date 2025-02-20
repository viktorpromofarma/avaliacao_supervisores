<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sellers extends Model
{
    protected $table = 'PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES';

    protected $fillable = [
        'supervisor',
        'nome_supervisor',
        'gerente_atual',
        'nome',
        'loja',
        'data_entrada',
        'data_saida'
    ];

    public $timestamps = false;
}
