<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Http\Controllers\Verification\StatusAnswers;


class HomeController extends Controller
{
    public $roules = '';

    public function index()
    {

        $statusAnswers = $this->getUserAnswersStatus(Auth::user()->id);


        $roules = $this->getRoules();
        return view('home', [
            'roules' => $roules,
            'statusAnswers'    => $statusAnswers,
            'user_id' => Auth::user()->id

        ]);
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

    public function getUserAnswersStatus($user_id)
    {
        return (new StatusAnswers())->getUserAnswersStatus($user_id);
    }
}
