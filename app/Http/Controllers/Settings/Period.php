<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Period as PeriodModel;

class Period extends Controller
{
    public function index()
    {
        $period = $this->getPeriod();

        return view('settings.period', ['periods' => $period]);
    }

    public function store(Request $request)
    {
        $mes = $request->mes;
        $ano = $request->ano;

        $primeiroDia = new \DateTime("$ano-$mes-01");
        $ultimoDia = new \DateTime("$ano-$mes-01");
        $ultimoDia->modify('last day of this month');

        try {
            PeriodModel::create([
                'month' => $mes,
                'year' => $ano,
                'start' => $primeiroDia->format('d-m-Y'),
                'end' => $ultimoDia->format('d-m-Y'),
                'created_at' => date('d-m-Y')

            ]);

            return back()->with('success', 'Período cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Erro ao cadastrar período!');
        }
    }

    public function getPeriod()
    {

        return PeriodModel::query()
            ->select('id', 'month', 'year', 'start', 'end')
            ->get()
            ->map(function ($item) {
                $item->start = date('d-m-Y', strtotime($item->start));
                $item->end = date('d-m-Y', strtotime($item->end));
                return $item;
            });
    }

    public function destroy($id)
    {
        PeriodModel::where('id', $id)->delete();
        return back()->with('success', 'Período excluido com sucesso!');
    }
}
