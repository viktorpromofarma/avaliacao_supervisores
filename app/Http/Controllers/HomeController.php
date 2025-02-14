<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sellers;

class HomeController extends Controller
{
    public $roules = '';

    public function index()
    {
        $roules = $this->getRoules();
        return view('home', ['roules' => $roules]);
    }

    public function getRoules()
    {
        if (Sellers::where('supervisor', Auth::user()->seller)->Exists()) {
            return $this->roules = 'supervisor';
        } elseif (Sellers::where('gerente_atual', Auth::user()->seller)->Exists()) {
            return $this->roules = 'gerente';
        } elseif (Auth::user()->seller == 4971) {
            return $this->roules = 'admin';
        };
    }
}
