<?php

namespace App\Http\Controllers\Authentication;


use Illuminate\Http\Request;
use App\Http\Controllers\Verification\VerifyUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\IFTTTHandler;
use Whoops\Exception\Formatter;

use function Laravel\Prompts\form;

class CreateAccount extends VerifyUsers
{
    public function store(Request $request)
    {

        $registerValidation = $this->getSellerProcfit($request->id);

        if (!$registerValidation) {
            return back()->with('error', 'Matrícula inválida. Tente novamente');
        }

        $request->merge([
            'password' => trim($request->input('password')),
            'confirm_password' => trim($request->input('confirm_password')),
        ]);

        $credentials = $request->validate([
            'username' => 'required|string|min:6|regex:/^\S+$/',
            'name'      => 'required|string|min:6',
            'password'  => 'required|string|min:6',
            'confirm_password' => 'required|string|min:8|same:password',
        ], [
            'username.required' => 'O campo nome de usuário é obrigatório.',
            'username.min' => 'O nome de usuário deve ter pelo menos 6 caracteres.',
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter pelo menos 6 caracteres.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'confirm_password.required' => 'O campo confirmar senha é obrigatório.',
            'confirm_password.min' => 'A confirmar senha deve ter pelo menos 8 caracteres.',
            'confirm_password.same' => 'A senha e a confirmar senha devem ser iguais.',
            'regex' => 'O campo usuario tem um formato inválido.',
        ]);

        User::firstORCreate([
            'username' => $credentials['username'],
            'password' => Hash::make($credentials['password']),
            'display_name' => $credentials['name'],
            'seller' => $request->id,
            'created_at' => date('d-m-Y'),

        ]);

        return redirect()->route('login');
    }

    public function getSellerProcfit($seller)
    {
        return parent::getSellerProcfit($seller);
    }
}
