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

        return view('home', [
            'user' => Auth::user(),

            'validationPeriodoAnswers' => $validationPeriodoAnswers

        ]);
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
