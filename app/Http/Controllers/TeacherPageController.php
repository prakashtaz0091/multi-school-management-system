<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPageController extends Controller
{

    private function getLoggedInTeacherInfo()  #simply do this function call to get logged in teacher information
    {
        $user_id = Auth::user()->id;
        $teacher = User::with('staff')->find($user_id);
        return $teacher;
    }
    public function homepage()
    {

        $teacher = $this->getLoggedInTeacherInfo();
        // dd($teacher);
        return view('teacher.homepage', compact('teacher'));
    }


    public function attendence_page()
    {

        $teacher = $this->getLoggedInTeacherInfo();
        $classes = $teacher->staff->classes;
        return view('teacher.attendence_page', compact('teacher', 'classes'));
    }
}
