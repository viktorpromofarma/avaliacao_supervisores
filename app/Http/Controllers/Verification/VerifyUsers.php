<?php

namespace App\Http\Controllers\Verification;

use App\Http\Controllers\Controller;
use App\Models\Sellers;
use App\Models\User;
use App\Models\SellersProcfit;
use Illuminate\Support\Facades\DB;


class VerifyUsers extends Controller
{

    public function getExistUser($seller)
    {
        $getUser = $this->getUser($seller);
        $getSellerProcfit = $this->getSellerProcfit($seller);
        $getSeller = $this->getSeller($seller);




        if ($getUser == false) {

            if ($getSeller == false) {

                if ($getSellerProcfit == false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function getUser($seller)
    {
        return User::where('username', $seller)
            ->leftJoin('access_roles', 'access_roles.user_id', '=', 'usuarios_avaliacao_supervisao.id')
            ->where('access_roles.operator', '<>', 1)
            ->Exists();
    }
    public function getSellerProcfit($seller)
    {
        return  SellersProcfit::where((DB::raw('cast(matricula AS CHAR)')), $seller)
            ->whereIn('matricula', [3082, 4971, 2446, 6349])
            ->Exists();
    }
    public function getSeller($seller)
    {
        $general = Sellers::where((DB::raw('CAST(supervisor AS CHAR)')), $seller)
            ->orWhere((DB::raw('CAST(gerente_atual AS CHAR)')), $seller)
            ->where('data_saida', null)
            ->Exists();

        return $general;
    }

    public function getOperator($seller)
    {
        return User::where('username', $seller)
            ->leftJoin('access_roles', 'access_roles.user_id', '=', 'usuarios_avaliacao_supervisao.id')
            ->where('access_roles.operator', 1)
            ->Exists();
    }
}
