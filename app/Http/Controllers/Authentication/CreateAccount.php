<?php

namespace App\Http\Controllers\Authentication;


use Illuminate\Http\Request;
use App\Http\Controllers\Verification\VerifyUsers;
use Monolog\Handler\IFTTTHandler;

class CreateAccount extends VerifyUsers
{
    public function store(Request $request)
    {
        $Sellers = $this->getSeller($request->id);

        if ($Sellers == false) {
            return redirect()->route('login');
        }
    }

    public function getSeller($seller)
    {
        return parent::getSeller($seller);
    }
}
