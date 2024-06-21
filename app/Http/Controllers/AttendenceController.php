<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendenceController extends Controller
{
    public function index()
    {
        $school_id = Auth::user()->school_id;
        $attendance_records = Attendance::with('class', 'student')->where([
            'school_id' => $school_id,
        ])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('class_id')
            ->map(function ($classGroup) {
                return $classGroup->groupBy(function ($attendance) {
                    return $attendance->created_at->format('Y-m-d');
                });
            });

        // dd($attendance_records->first());

        return view('school_admin.view_attendence', compact('attendance_records'));
    }
}
