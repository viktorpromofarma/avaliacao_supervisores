<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Questions extends Controller
{
    public function __invoke()
    {
        return view('form.questions');
    }
}
