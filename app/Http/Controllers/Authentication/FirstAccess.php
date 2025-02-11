<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FirstAccess extends Controller
{
    public function __invoke($id)
    {
        return view('authentication.first-access', ['id' => $id]);
    }
}
