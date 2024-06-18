<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherPageController extends Controller
{
    public function homepage()
    {
        $user_id = Auth::user()->id;
        $teacher = User::with('staff')->find($user_id);
        // dd($teacher);
        return view('teacher.homepage', compact('teacher'));
    }
}
