<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Evaluation_History extends Controller
{
    public function index()
    {

        return view('admin.evaluation_history');
    }
}
