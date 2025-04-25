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
        $primeiroDia = $request->inicial;
        $ultimoDia = $request->final;
        $mes = date('m', strtotime($ultimoDia));
        $ano = date('Y', strtotime($ultimoDia));

        try {
            PeriodModel::create([
                'month' => $mes,
                'year' => $ano,
                'start' => $primeiroDia,
                'end' => $ultimoDia,
                'created_at' => date('d-m-Y')

            ]);

            return back()->with('success', 'Período cadastrado com sucesso!');
        } catch (\Throwable $th) {
            dd($th);
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
