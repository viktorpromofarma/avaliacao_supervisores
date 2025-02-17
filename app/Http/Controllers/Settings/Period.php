<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Period extends Controller
{
    public function index()
    {
        $periods = $this->getPeriod();


        return view('settings.period', ['periods' => $periods]);
    }

    public function store(Request $request)
    {
        $mes = $request->mes;
        $ano = $request->ano;


        $primeiroDia = new \DateTime("$ano-$mes-01");
        $ultimoDia = new \DateTime("$ano-$mes-01");
        $ultimoDia->modify('last day of this month');

        dd([
            $mes,
            $ano,
            'primeiro_dia' => $primeiroDia->format('Y-m-d'),
            'ultimo_dia' => $ultimoDia->format('Y-m-d'),
        ]);
    }

    public function getPeriod()
    {
        $meses = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro'
        ];

        $ano = 2025;

        $periods = [];

        foreach ([3, 4, 5] as $mes) { // Março, Abril e Maio
            $primeiroDia = new \DateTime("$ano-$mes-01");
            $ultimoDia = new \DateTime("$ano-$mes-01");
            $ultimoDia->modify('last day of this month');

            $periods[] = [
                'mes' => $meses[$mes],
                'ano' => $ano,
                'primeiro_dia' => $primeiroDia->format('d-m-Y'),
                'ultimo_dia' => $ultimoDia->format('d-m-Y'),
            ];
        }

        return $periods;
    }
}
