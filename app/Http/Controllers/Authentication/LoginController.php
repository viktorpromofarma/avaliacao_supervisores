<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string|min:1',
            'password' => 'required|string|min:8',
        ], [
            'username.required' => 'O campo nome de usuário é obrigatório.',
            'username.string' => 'O nome de usuário deve ser uma string.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'A senha deve ser uma string.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
        ]);


        $verifySeller = $this->VerifySeller($credentials['username']);




        if ($verifySeller == true && $credentials['password'] == 'promofarma') {
            return redirect()->route('first-access', ['id' => $credentials['username']]);
        }

        $user = User::where('username', $credentials['username'])->first();



        if (!$user || !Hash::check($credentials['password'], $user->password) || $user->active == 'N') {

            return back()->with('error', 'Usuário ou senha inválidos');
        }

        Auth::login($user);
        $request->session()->regenerate();
        session(['username' => $user->username]);
        return redirect('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        session()->forget('username');

        return redirect()->route('login');
    }

    public function VerifySeller($seller)
    {
        return (new VerifySeller())->getRegister($seller);
    }
}
