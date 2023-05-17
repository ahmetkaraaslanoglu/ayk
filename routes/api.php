<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::prefix('/auth')->name('.auth')->group(function () {
//    Route::prefix('/student')->name('.student')->group(function () {
//        Route::post('/login',[\App\Http\Controllers\Api\Auth\StudentController::class,'login'])->name('student.login');
//    });
//    Route::prefix('/teacher')->name('.teacher')->group(function () {
//        Route::post('/login',[\App\Http\Controllers\Api\Auth\TeacherController::class,'login'])->name('teacher.login');
//    });
//    Route::prefix('/user')->name('.user')->group(function () {
//        Route::post('/login',[\App\Http\Controllers\Api\Auth\UserController::class,'login'])->name('user.login');
//    });
//});
//
//
//
//Route::get('/homeworks/{homework}/students',[\App\Http\Controllers\Api\HomeworkController::class,'students_homework'])->name('homeworks.student');
//Route::resource('/homeworks',\App\Http\Controllers\Api\HomeworkController::class);
//Route::get('/homeworks/{homeworks}',\App\Http\Controllers\Api\HomeworkController::class);
