<?php

use App\Http\Controllers\Web\ChatRoomController;
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
    Route::get('/login',[\App\Http\Controllers\Web\AuthController::class, 'view']);
    Route::post('/login',[\App\Http\Controllers\Web\AuthController::class,'login']);
});

//Route::get('/login/{type}',[\App\Http\Controllers\Web\AuthController::class, 'view'])->name('login');
//Route::post('/login/{type}',[\App\Http\Controllers\Web\AuthController::class,'login']);
//Route::get('/logout/{type}',[\App\Http\Controllers\Web\AuthController::class,'logout'])->name('logout');

//Route::middleware('auth:student')->group(function () {
//   Route::resource('homeworks',\App\Http\Controllers\Web\Student\HomeworkController::class);
//   Route::resource('exams',\App\Http\Controllers\Web\Student\ExamController::class);
//   Route::resource('absenteeism',\App\Http\Controllers\Web\Student\AbsenteeismController::class);
//    Route::resource('teachers',\App\Http\Controllers\Web\Student\TeacherController::class);
//    Route::resource('messages',\App\Http\Controllers\Web\Student\MessageController::class);
//});

Route::middleware('auth')->name('web.')->group(function () {
    Route::get('/logout',[\App\Http\Controllers\Web\AuthController::class,'logout'])->name('logout');

    Route::resource('homeworks',\App\Http\Controllers\Web\HomeworkController::class)->only(['index']);
    Route::resource('exams',\App\Http\Controllers\Web\ExamController::class);
    Route::resource('absences',\App\Http\Controllers\Web\AbsenceController::class);

    Route::get('/chat_rooms', [ChatRoomController::class, 'index'])->name('chat_rooms.index');
    Route::get('/chat_rooms/{chatRoom}', [ChatRoomController::class, 'show'])->name('chat_rooms.show');
    Route::post('/chat_rooms/{chatRoom}', [ChatRoomController::class, 'store'])->name('chat_rooms.store');

    Route::get('/dashboard',[\App\Http\Controllers\Web\Student\DashboardController::class,'index'])->name('dashboard');
});

//Route::middleware('auth:teacher')->prefix('/teacher')->name('teacher.')->group(function () {
//    Route::resource('homeworks',\App\Http\Controllers\Web\Teacher\HomeworkController::class);
//    Route::resource('exams',\App\Http\Controllers\Web\Teacher\ExamController::class);
//    Route::resource('messages',\App\Http\Controllers\Web\Teacher\MessageController::class);
//    Route::resource('students',\App\Http\Controllers\Web\Teacher\StudentController::class);
//    Route::resource('absenteeism',\App\Http\Controllers\Web\Teacher\AbsenteeismController::class);
//
//   Route::view('/asd','web.teams.team');
//});
