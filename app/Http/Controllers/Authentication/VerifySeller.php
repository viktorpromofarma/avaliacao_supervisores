<?php

namespace App\Http\Controllers\Authentication;


use App\Http\Controllers\Verification\VerifyUsers;

class VerifySeller extends VerifyUsers
{

    public function getRegister($seller)
    {

        $existUser = $this->getExistUser($seller);

        return $existUser;
    }
}
