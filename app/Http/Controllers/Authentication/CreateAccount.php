<?php

namespace App\Http\Controllers\Authentication;


use App\Models\User;
use App\Models\Sellers;
use App\Models\AccessRoles;
use Illuminate\Http\Request;
use function Laravel\Prompts\form;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Verification\VerifyUsers;

class CreateAccount extends VerifyUsers
{
    public function store(Request $request)
    {


        $registerValidation = $this->getExistUser($request->id);


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
            'active' => 'S',
            'created_at' => date('d-m-Y'),

        ]);

        $this->setUsersRoles($request->id);

        return redirect()->route('login');
    }

    public function getExistUser($seller)
    {
        return parent::getExistUser($seller);
    }

    public function setUsersRoles($seller)
    {
        $user = User::where('seller', $seller)->first();


        $user_id = $user->id;

        $supervisor = Sellers::where(DB::raw('CAST(supervisor AS CHAR)'), $seller)->first();
        $gerente = Sellers::where('gerente_atual', '=', $seller)->first();




        if ($supervisor) {
            $data = [
                'admin' => false,
                'root' => false,
                'supervisor' => false,
                'regional' => true,
                'gerentes' => false,
            ];
        } elseif ($gerente) {
            $data = [
                'admin' => false,
                'root' => false,
                'supervisor' => false,
                'regional' => false,
                'gerentes' => true,
            ];
        } else {
            $data = match ($seller) {
                "4971" => [
                    'admin' => true,
                    'root' => false,
                    'supervisor' => false,
                    'regional' => false,
                    'gerentes' => false,
                ],
                "2446" => [
                    'admin' => false,
                    'root' => false,
                    'supervisor' => true,
                    'regional' => false,
                    'gerentes' => false,
                ],
                "3082" => [
                    'admin' => false,
                    'root' => true,
                    'supervisor' => false,
                    'regional' => false,
                    'gerentes' => false,
                ],
                "6349" => [
                    'admin' => true,
                    'root' => false,
                    'supervisor' => false,
                    'regional' => false,
                    'gerentes' => false,
                ]
            };
        }

        AccessRoles::firstOrCreate(
            ['user_id' => $user_id],
            ['created_at' => date('d-m-Y'), ...$data]
        );
    }
}
