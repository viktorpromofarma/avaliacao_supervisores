<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Verification\StatusAnswers;

class HomeController extends Controller
{
    public $roules = '';

    public function index()
    {

        $period = $this->getPeriod();

        if ($period == null) {


            return view('home', [
                'user' => Auth::user(),
                'validationPeriodoAnswers' => true
            ]);
        } else {


            $validationPeriodoAnswers = $this->validationPeriodoAnswers();

            return view('home', [
                'user' => Auth::user(),
                'validationPeriodoAnswers' => $validationPeriodoAnswers
            ]);
        }
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
        $user = Auth::user();

        if ($user->accessRole->supervisor || $user->accessRole->regional || $user->accessRole->admin || $user->accessRole->root) {

            $statusAnswers = $this->getUserAnswersStatus(Auth::user()->id);
        }

        if ($user->accessRole->gerentes) {

            $statusAnswers = $this->getUserAnswersStatus(Auth::user()->id)->first();

            if ($statusAnswers) {
                return false;
            } else {
                return true;
            }
        }

        $statusPeriod = $this->getPeriod()->first();

        if ($statusPeriod == null) {
            return null;
        } else {
            return $statusAnswers;
        }
    }
}
