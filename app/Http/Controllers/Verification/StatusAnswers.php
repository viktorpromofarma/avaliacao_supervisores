<?php

namespace App\Http\Controllers\Verification;

use App\Models\Period;
use App\Models\Sellers;
use App\Models\StatusUserAnswers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class StatusAnswers extends Controller
{

    public function getUserAnswersStatus($user_id)
    {
        $user = Auth::user();

        $period = Period::where('year', date('Y'))->where('month', date('m'))->orderBy('id', 'desc')->first();


        $start = date('d-m-Y', strtotime($period->start));
        $end = date('d-m-Y', strtotime($period->end));

        if ($user->accessRole->supervisor || $user->accessRole->regional || $user->accessRole->admin) {

            return StatusUserAnswers::query()
                ->where('user_id', $user_id)
                ->whereExists(function ($query) use ($start, $end) {
                    $query->select(DB::raw(1))
                        ->from('period')
                        ->whereRaw(
                            'status_user_answers.created_at BETWEEN ? AND ?',
                            [$start, $end]

                        );
                })
                ->Exists();
        }

        if ($user->accessRole->gerentes) {


            return Sellers::query()
                ->join('usuarios_avaliacao_supervisao as b', function ($join) {
                    $join->on('PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES.GERENTE_ATUAL', '=', 'b.seller');
                })
                ->leftjoin('status_user_answers as c', function ($join) use ($start, $end) {
                    $join->on('b.id', '=', 'c.user_id')
                        ->on('PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES.loja', '=', 'c.store')
                        ->whereExists(function ($query) use ($start, $end) {
                            $query->select(DB::raw(1))
                                ->from('period')
                                ->whereRaw('c.created_at BETWEEN ? and ?',  [$start, $end]);
                        });
                })->where('b.id', $user_id)
                ->whereNull('c.id')
                ->select('PBS_PROMOFARMA_DADOS.dbo.VW_HISTORICO_GERENTES.SUPERVISOR', 'NOME_SUPERVISOR', 'GERENTE_ATUAL', 'NOME', 'LOJA')->get();
        }
    }


    public function getPeriod()
    {
        return Period::where('start', '<=', date('d-m-Y'))->where('end', '>=', date('d-m-Y'))->first();
    }
}
