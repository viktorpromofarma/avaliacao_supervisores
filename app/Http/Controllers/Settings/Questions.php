<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Questions extends Controller
{
    public function index()
    {

        return view('settings.questions');
    }

    public function store(Request $request)
    {

        dd($request->all());
    }
}
