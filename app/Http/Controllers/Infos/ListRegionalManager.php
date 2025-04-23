<?php

namespace App\Http\Controllers\Infos;

use App\Http\Controllers\Controller;
use App\Models\Sellers;


class ListRegionalManager extends Controller
{


    public function index()
    {
        $listRegionalManager = $this->getRegionalManager();



        return view('admin.infos.history_regional_manager', ['history_regional_manager' => $listRegionalManager]);
    }


    public function getRegionalManager()
    {
        return Sellers::query()
            ->orderBy('loja')
            ->orderBy('data_entrada')
            ->get();
    }
}
