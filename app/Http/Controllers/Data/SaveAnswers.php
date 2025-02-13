<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveAnswers extends Controller
{
    public function store(Request $request)
    {

        dd($request->all());
    }
}
