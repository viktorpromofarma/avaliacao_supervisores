<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Models\User;
use App\Models\SellersProcfit;
use Illuminate\Support\Facades\DB;


class VerifyUsers extends Controller
{

    public function getExistUser($seller)
    {
        $user = $this->getUser($seller);
        $procfit = $this->getSellerProcfit($seller);
        $registration = $this->getSeller($seller);

        if (!$user) {
            if (!$procfit) {
                return false;
            } else {
                if (!$registration) {
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    public function getUser($seller)
    {
        return User::where('username', $seller)->Exists();
    }
    public function getSellerProcfit($seller)
    {
        return SellersProcfit::where((DB::raw('cast(matricula AS CHAR)')), $seller)->Exists();
    }
    public function getSeller($seller)
    {
        $general = Sellers::where((DB::raw('CAST(supervisor AS CHAR)')), $seller)
            ->orWhere((DB::raw('CAST(gerente_atual AS CHAR)')), $seller)
            ->where('data_saida', null)
            ->Exists();

        if ($seller != 4971) {
            return $general;
        } else {
            return true;
        }
    }
}
