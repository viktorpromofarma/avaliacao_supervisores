<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Generate_Feedback extends Controller
{
    public function index()
    {
        return view('admin.generate_feedback');
    }
}
