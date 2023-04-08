<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function login(Request $request):JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (! auth('student')->attempt($credentials)) {
            return ApiResponse::error(message: 'Invalid credentials', code: 401);
        }

        /** @var Student $student */
        $student = auth('student')->user();
        $student->update(['token' => $token = Str::random(40)]);

        return ApiResponse::success([
            'id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
            'token' => $token,
        ]);

    }

    public function logout(Request $request): JsonResponse
    {
        return response()->json(['success' => true, 'message' => '', 'data' => null], 200);
    }

}
