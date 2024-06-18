<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\GuardianController;
use App\Http\Controllers\SchoolAdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
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

    Route::get('/dashboard', [SchoolAdminController::class, 'dashboard'])->name('school_admin.dashboard');
    Route::resource('/staffs', StaffController::class)->names('school_admin.staffs');
    Route::resource('/students', StudentController::class)->names('school_admin.students');
    Route::resource('/guardians', GuardianController::class)->names('school_admin.guardians');
    Route::resource('/classes', ClassController::class)->names('school_admin.classes');
    Route::resource('/subjects', SubjectController::class)->names('school_admin.subjects');
    Route::resource('/exams', ExamController::class)->names('school_admin.exams');
    Route::get('/class/get-subjects/{class_id}', [ExamController::class, 'getSubjectsForClass'])->name('school_admin.exams.getSubjectsForClass');
    Route::get('/exams/add-subjects/{exam_id}', [ExamController::class, 'addSubjects'])->name('school_admin.exams.addSubjects');
    Route::post('/exams/store-subjects-exam/{exam_id}', [ExamController::class, 'storeSubjects_Exam'])->name('school_admin.exams.storeSubjects_Exam');
});


Route::group(['prefix' => 'teacher', 'middleware' => ['auth']], function () {

    Route::get('/dashboard', function () {
        echo "teacher dashboard";
    });
});


Route::group(['prefix' => 'student', 'middleware' => ['auth', 'isStudentOrGuardian']], function () {

    Route::get('/home', function () {
        echo "student home";
    });
});
