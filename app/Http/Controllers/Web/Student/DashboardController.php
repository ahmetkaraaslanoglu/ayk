<?php

namespace App\Http\Controllers\Web\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return response()->view('web.dashboard.dashboard',compact('user'));
    }
}
