<?php

namespace App\Http\Controllers\Question;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Questions extends Controller
{
    public function __invoke()
    {



        return view('form.questions', ['user' => Auth::user()]);
    }
}
