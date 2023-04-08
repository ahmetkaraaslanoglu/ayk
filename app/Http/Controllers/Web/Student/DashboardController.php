<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();
        return response()->view('web.dashboard.dashboard',compact('student'));
    }
}
