<?php

namespace App\Http\Controllers\Authentication;


use App\Http\Controllers\Verification\VerifyUsers;

class VerifySeller extends VerifyUsers
{

    public function getRegister($seller)
    {

        $Sellers = $this->getSeller($seller);
        $Users = $this->getUser($seller);



        if ($Sellers != $Users) {
            return false;
        } else {
            return true;
        }
    }
}
