<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\User;

class VerifyUsers extends Controller
{
    public function getSeller($seller)
    {
        return  Sellers::where('supervisor', $seller)
            ->orWhere('gerente_atual', $seller)
            ->where('data_saida', null)
            ->Exists();
    }

    public function getUser($seller)
    {
        return User::where('username', $seller)->doesntExist();
    }
}
