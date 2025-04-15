<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Sellers;
use App\Http\Controllers\Verification\StatusAnswers;
use Termwind\Components\Dd;

class HomeController extends Controller
{
    public $roules = '';

    public function index()
    {
        $validationPeriodoAnswers = $this->validationPeriodoAnswers();

        // dd($validationPeriodoAnswers);

        $roules = $this->getRoules();
        return view('home', [
            'roules' => $roules,
            'user_id' => Auth::user()->id,
            'validationPeriodoAnswers' => $validationPeriodoAnswers

        ]);
    }

    public function getRoules()
    {
        if (Sellers::where('supervisor', Auth::user()->seller)->Exists()) {
            return $this->roules = 'supervisor';
        } elseif (Sellers::where('gerente_atual', Auth::user()->seller)->Exists()) {
            return $this->roules = 'gerente';
        } elseif (Auth::user()->seller == 4971 || Auth::user()->seller == 3082) {
            return $this->roules = 'admin';
        } elseif (Auth::user()->seller == 2446) {
            return $this->roules = 'supervisor_geral';
        };
    }

    public function getUserAnswersStatus($user_id)
    {
        return (new StatusAnswers())->getUserAnswersStatus($user_id);
    }

    public function getPeriod()
    {
        return (new StatusAnswers())->getPeriod();
    }

    public function validationPeriodoAnswers()
    {

        $statusAnswers = $this->getUserAnswersStatus(Auth::user()->id)->first();

        $statusPeriod = $this->getPeriod()->where('year', date('Y'))->where('month', date('m'))->first();


        if ($statusPeriod == null) {
            return null;
        } else {
            return $statusAnswers;
        }
    }
}
