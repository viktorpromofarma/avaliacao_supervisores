<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use App\Models\StatusUserAnswers;
use App\Models\Period;
use App\Models\Sellers;
use Illuminate\Support\Facades\Auth;



class StatusAnswers extends Controller
{

    public function getUserAnswersStatus($user_id)
    {
        $user = Auth::user();

        if ($user->accessRole->supervisor || $user->accessRole->regional || $user->accessRole->admin) {

            return StatusUserAnswers::query()
                ->join('period', function ($join) {
                    $join->on('status_user_answers.month', '=', 'period.month')
                        ->on('status_user_answers.year', '=', 'period.year');
                })
                ->where('user_id', $user_id)
                ->where('period.month', date('m'))
                ->where('period.year', date('Y'))
                ->Exists();
        }

        if ($user->accessRole->gerentes) {

            return  Sellers::query()
                ->join('usuarios_avaliacao_supervisao as b', function ($join) {
                    $join->on('PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES.GERENTE_ATUAL', '=', 'b.seller');
                })
                ->leftjoin('status_user_answers as c', function ($join) {
                    $join->on('b.id', '=', 'c.user_id')
                        ->on('PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES.loja', '=', 'c.store');
                })
                ->leftjoin('period as d', function ($join) {
                    $join->on('c.month', '=', 'd.month')
                        ->on('c.year', '=', 'd.year')
                        ->where('d.month', date('m'))
                        ->where('d.year', date('Y'));
                })->where('b.id', $user_id)
                ->whereNull('c.id')
                ->select('PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES.SUPERVISOR', 'NOME_SUPERVISOR', 'GERENTE_ATUAL', 'NOME', 'LOJA');
        }
    }

    public function getPeriod()
    {
        return Period::all();
    }
}
