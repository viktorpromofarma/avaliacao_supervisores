<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|integer|min:1',
            'password' => 'required|string',
        ]);

        $verifySeller = $this->VerifySeller($credentials['username']);

        if ($verifySeller == true) {
            return redirect()->route('first-access', ['id' => $credentials['username']]);
        }


        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'Não foi possível fazer login com essas credenciais.'
                ])
                ->withInput(['email']);
        }
        return redirect('home'); // to_route
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    public function VerifySeller($seller)
    {

        return (new VerifySeller())->getRegister($seller);
    }
}
