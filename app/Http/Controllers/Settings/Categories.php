<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Categories extends Controller
{
    public function index()
    {

        return view('settings.categories');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
