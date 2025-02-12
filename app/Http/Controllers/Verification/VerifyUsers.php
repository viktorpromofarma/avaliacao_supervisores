<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\User;

class VerifyUsers extends Controller
{

    public function getExistUser($seller)
    {
        $User = $this->getUser($seller);
        $seller = $this->getSeller($seller);

        if ($User == true) {
            return true;
        } else {

            if ($seller == true) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function getSeller($seller)
    {
        $register = User::where('username', $seller)->select('seller')->first();

        if ($register == null) {
            return false;
        } else {
            return Sellers::where('supervisor', $register->seller)
                ->orWhere('gerente_atual', $register->seller)
                ->where('data_saida', null)
                ->Exists();
        }
    }

    public function getUser($seller)
    {
        return User::where('username', $seller)->Exists();
    }
}
