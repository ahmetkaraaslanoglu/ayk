<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function login(Request $request):JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth('teacher')->attempt($credentials)) {
            return ApiResponse::error(message: 'Invalid credentials', code: 401);
        }

        /** @var Teacher $teacher */
        $teacher = auth('teacher')->user();
        $teacher->update(['token' => $token = Str::random(40)]);

        return ApiResponse::success([
            'id' => $teacher->id,
            'name' => $teacher->name,
            'email' => $teacher->email,
            'token' => $token,
        ]);

    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 'message' => '', 'data' => null], 200);
    }
}
