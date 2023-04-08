<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request):JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth('user')->attempt($credentials)) {
            return ApiResponse::error(message: 'Invalid credentials', code: 401);
        }

        /** @var User $user */
        $user = auth('user')->user();
        $user->update(['token' => $token = Str::random(40)]);

        return ApiResponse::success([
            'id' => $user->id,
            'firstName' => $user->first_name,
            'lastName' => $user->last_name,
            'email' => $user->email,
            'profilePhotoUrl' => $user->profile_photo_url,
            'token' => $token,
        ]);

    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 'message' => '', 'data' => null], 200);
    }

}
