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
}
