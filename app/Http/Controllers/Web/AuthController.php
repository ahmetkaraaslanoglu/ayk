<?php

namespace App\Http\Controllers\Web;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function view(): \Illuminate\Http\Response
    {
        return response()->view('web.auth.login');
    }

    public function register_view(): \Illuminate\Http\Response
    {
        return response()->view('web.auth.register');
    }


    public function login(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
           'email' => 'required|email',
           'password' => 'required',
        ]);

        auth()->logout();

        if (auth()->attempt($validated)){
            return redirect()->to('/chat_rooms');
        }

        return redirect()->back()->withErrors([
           'login' => 'Kullanıcı adı veya parola yanlış...'
        ]);
    }

    public function register(Request $request): \Illuminate\Http\RedirectResponse
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $token = Str::random(40);

        $user = User::query()->create([
            'lesson_id' => null,
            'role' => Role::Guest->value,
            'school_id' => null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'profile_photo_url' => asset('/unknown_user.png'),
            'token' => $token,
        ]);



        return redirect()->to('/login');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->to('/');
    }

}
