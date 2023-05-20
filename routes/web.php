<?php

use App\Http\Controllers\Web;
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

Route::middleware('guest')->group(function () {
    Route::get('/login',[Web\AuthController::class, 'view']);
    Route::post('/login',[Web\AuthController::class,'login']);
});

Route::middleware('auth')->name('web.')->group(function () {
    Route::get('/logout',[Web\AuthController::class,'logout'])->name('logout');

    Route::resource('homeworks',\App\Http\Controllers\Web\HomeworkController::class)->only(['index','store']);
    Route::resource('exams',\App\Http\Controllers\Web\ExamController::class);
    Route::resource('absences',\App\Http\Controllers\Web\AbsenceController::class);
    Route::resource('teachers',\App\Http\Controllers\Web\TeacherController::class);
    Route::resource('students',\App\Http\Controllers\Web\StudentController::class);

    Route::get('/chat_rooms', [Web\ChatRoomController::class, 'index'])->name('chat_rooms.index');
    Route::get('/chat_rooms/{chatRoom}', [Web\ChatRoomController::class, 'show'])->name('chat_rooms.show');
    Route::post('/chat_rooms/{chatRoom}', [Web\ChatRoomController::class, 'store'])->name('chat_rooms.store');

    Route::get('/dashboard',[\App\Http\Controllers\Web\Student\DashboardController::class,'index'])->name('dashboard');
});

