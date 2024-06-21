<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Guardian;
use App\Models\User;
use App\Models\School;
use App\Models\Staff;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolAdminController extends Controller
{
    public function dashboard()
    {



        $auth_id = Auth::user()->id;
        $user_with_school = User::with('school')->find($auth_id);
        $school_id = $user_with_school->school_id;

        $students = Student::where('school_id', $school_id)->count();
        $staffs = Staff::where('school_id', $school_id)->count();
        $guardians = Guardian::where('school_id', $school_id)->count();
        $subjects = Subject::where('school_id', $school_id)->count();
        $classes = Classes::where('school_id', $school_id)->count();
        // dd($user_with_school);
        // dd($students, $staffs, $guardians, $subjects, $classes);
        return view('school_admin.dashboard', compact('user_with_school', 'students', 'staffs', 'guardians', 'subjects', 'classes'));
    }
}
