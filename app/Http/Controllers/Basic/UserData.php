<?php

namespace App\Http\Controllers\Basic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sellers;

class UserData extends Controller
{
    public function getUserData($id)
    {
        return User::query()->where('id', $id)->first();
    }
    public function getSupervisorStore($id)
    {
        return Sellers::query()
            ->where('supervisor', $id)
            ->select('LOJA')
            ->whereNull('data_saida')->get();
    }

    public function getSupervisor($id, $store = null)
    {
        if ($store == null) {
            return Sellers::query()
                ->where('supervisor', $id)
                ->whereNull('data_saida')
                ->Exists();
        } else {

            return Sellers::query()
                ->where('supervisor', $id)
                ->where('loja', $store)
                ->Exists();
        }
    }

    public function getManager($id)
    {
        return Sellers::query()
            ->where('gerente_atual', $id)
            ->Exists();
    }
}
