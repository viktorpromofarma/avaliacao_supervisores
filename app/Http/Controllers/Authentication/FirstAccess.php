<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FirstAccess extends Controller
{
    public function __invoke($id)
    {
        if ($this->validateSeller($id)) {
            return redirect()->route('login');
        }

        return view('authentication.first-access', ['id' => $id]);
    }

    public function validateSeller($id)
    {

        return User::where('seller', $id)->Exists();
    }
}
