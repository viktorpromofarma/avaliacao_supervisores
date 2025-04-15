<?php

namespace App\Http\Controllers\Authentication;

use App\Models\User;
use App\Models\SellersProcfit;
use App\Http\Controllers\Controller;


class FirstAccess extends Controller
{
    public function __invoke($id)
    {
        if ($this->validateSeller($id)) {
            return redirect()->route('login');
        }

        $defaultUser = $this->getDefaultUser($id)->inscricao_federal;

        $defaultUser = preg_replace('/[^0-9]/', '', $defaultUser);

        return view('authentication.first-access', ['id' => $id, 'username' => $defaultUser]);
    }

    public function validateSeller($id)
    {

        return User::where('seller', $id)->Exists();
    }

    public function getDefaultUser($id)
    {
        return SellersProcfit::query()
            ->where('matricula', $id)
            ->select('inscricao_federal')
            ->first();
    }
}
