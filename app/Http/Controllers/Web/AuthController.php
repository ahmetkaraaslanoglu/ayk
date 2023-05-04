<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function view(Request $request, string $type)
    {
        abort_unless(in_array($type, ['user', 'student', 'teacher']), 400);
        return response()->view('web.auth.student_login', compact('type'));
    }

    public function login(Request $request, string $type)
    {
        abort_unless(in_array($type, ['user', 'student', 'teacher']), 400);

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        auth('user')->logout();
        auth('teacher')->logout();
        auth('student')->logout();


        if (auth($request->input('type'))->attempt($validated)) {
            return redirect()->to('/dashboard');
        }

        return redirect()->route('login', $type)->withErrors([
            'auth' => 'şifre yada eposta yanlıi'
        ]);
    }

    public function logout()
    {
        auth('student')->logout();
        return redirect()->to('/');
    }
}
