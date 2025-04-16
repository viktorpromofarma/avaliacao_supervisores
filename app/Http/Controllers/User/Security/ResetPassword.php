<?php

namespace App\Http\Controllers\User\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Controller
{
    public function index()
    {


        $users = $this->getAllUsers();

        return view('user.resetPassword', ['users' => $users]);
    }


    public function getAllUsers()
    {
        return User::query()->where('active', 'S')
            ->where('id', '!=', Auth::user()->id)
            ->get();
    }

    public function updatePassword(Request $request)
    {

        $defaultPassword = 'Promo@1234';
        $criptedPassword = Hash::make($defaultPassword);

        User::where('id', $request->user)->update(['password' => $criptedPassword]);

        return redirect()->route('user.reset')->with('success', 'Perfil atualizado com sucesso!');
    }
}
