<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/{type}',[\App\Http\Controllers\Web\AuthController::class, 'view'])->name('login');
Route::post('/login/{type}',[\App\Http\Controllers\Web\AuthController::class,'login']);

Route::middleware('auth:student')->group(function () {
   Route::get('/logout/{type}',[\App\Http\Controllers\Web\AuthController::class,'logout'])->name('logout');
   Route::resource('homeworks',\App\Http\Controllers\Web\Student\HomeworkController::class);
   Route::resource('exams',\App\Http\Controllers\Web\Student\ExamController::class);
   Route::resource('absenteeism',\App\Http\Controllers\Web\Student\AbsenteeismController::class);
   Route::get('dashboard',[\App\Http\Controllers\Web\Student\DashboardController::class,'index'])->name('dashboard');
});


