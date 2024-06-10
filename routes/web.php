<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', [AuthController::class, 'showLogin'])->name('login_page');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::group(['prefix' => 'school-admin', 'middleware' => ['auth', 'isSchoolAdmin']], function () {

    Route::get('/dashboard', function () {
        return view('layout');
    });
});


Route::group(['prefix' => 'teacher', 'middleware' => ['auth', 'isTeacher']], function () {

    Route::get('/dashboard', function () {
        echo "teacher dashboard";
    });
});


Route::group(['prefix' => 'student', 'middleware' => ['auth', 'isStudentOrGuardian']], function () {

    Route::get('/home', function () {
        echo "student home";
    });
});
