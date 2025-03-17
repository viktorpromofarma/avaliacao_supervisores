<?php

namespace App\Http\Controllers\User\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Basic\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Profile extends Controller
{
    public function index(Request $request)
    {

        $userData = $this->getUser(Auth::user()->id);
        return view('user.profile', ['users' => $userData]);
    }

    public function getUser($id)
    {
        $user = new UserData();
        return $user->getUserData($id);
    }


    public function updateUser(Request $request)
    {



        $credentials = $request->validate([
            'username' => 'nullable|string|min:6|regex:/^\S+$/',
            'display_name' => 'nullable|string|min:6',
            'password' => 'nullable|string|min:6',
            'confirm_password' => 'nullable|string|min:8|same:password',
        ], [
            'confirm_password.min' => 'A confirmar senha deve ter pelo menos 8 caracteres.',
            'confirm_password.same' => 'A senha e a confirmar senha devem ser iguais.',
            'regex' => 'O campo usuário tem um formato inválido.',
        ]);


        $dataToUpdate = array_filter([
            'username' => $credentials['username'] ?? null,
            'display_name' => $credentials['display_name'] ?? null,
            'password' => isset($credentials['password']) ? Hash::make($credentials['password']) : null,
        ]);


        if (!empty($dataToUpdate)) {
            User::where('id', Auth::user()->id)->update($dataToUpdate);
        }

        $user = User::where('id', $request->user_id)->first();



        Auth::login($user);
        $request->session()->regenerate();
        session(['username' => $user->username]);
        return redirect()->route('user.profile')->with('success', 'Perfil atualizado com sucesso!');
    }
}
