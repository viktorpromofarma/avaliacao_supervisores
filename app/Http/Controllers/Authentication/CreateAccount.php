<?php

namespace App\Http\Controllers\Authentication;


use Illuminate\Http\Request;
use App\Http\Controllers\Verification\VerifyUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\IFTTTHandler;

class CreateAccount extends VerifyUsers
{
    public function store(Request $request)
    {




        $request->merge([
            'password' => trim($request->input('password')),
            'confirm_password' => trim($request->input('confirm_password')),
        ]);

        $credentials = $request->validate([
            'username' => 'required|string|min:6|regex:/^\S+$/',
            'name'      => 'required|string|min:6',
            'password'  => 'required|string|min:6',
            'confirm_password' => 'required|string|min:8|same:password',
        ]);

        User::firstORCreate([
            'username' => $credentials['username'],
            'password' => Hash::make($credentials['password']),
            'display_name' => $credentials['name'],
            'seller' => $request->id
        ]);

        return redirect()->route('login');
    }

    public function getSeller($seller)
    {
        return parent::getSeller($seller);
    }
}
