<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Feedback_History extends Controller
{
    public function index()
    {
        return view('admin.feedback_history');
    }
}
