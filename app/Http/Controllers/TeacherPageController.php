<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Attendance;
use App\Models\Classes;
use App\Models\Student;
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
        // dd(now());
        if (Attendance::whereDate('created_at', now())->exists()) {
            return redirect()->route('teacher.attendence_history')->with('warning', 'Attendence Already Taken For Today');
        }

        $teacher = $this->getLoggedInTeacherInfo();
        // dd($teacher);
        $class = Classes::where(['school_id' => $teacher->school_id, 'class_teacher_id' => $teacher->staff->id])->first();

        $students = Student::with('user')->where('class_id', $class->id)->get();
        // dd($students);
        return view('teacher.attendence_page', compact('teacher', 'class', 'students'));
    }



    public function attendence_store(Request $request)
    {
        // dd($request->all());

        $school_id = Auth::user()->school_id;
        $class_id = $request->class_id;

        $student_ids = Student::where('class_id', $class_id)->pluck('id');
        // dd($student_ids);
        // dd($class_id, $student_ids, $request->students);
        // dd(var_dump($student_ids[0]), var_dump($request->students[0]));
        // dd((int)$request->students[0]);
        // dd((string)$student_ids[1]);
        if ($request->students) {

            foreach ($student_ids as $student_id) {

                if (in_array((string)$student_id, $request->students)) {
                    Attendance::create([
                        'student_id' => $student_id,
                        'school_id' => $school_id,
                        'class_id' => $class_id,
                        'status' => 'present',
                    ]);
                } else {

                    Attendance::create([
                        'student_id' => $student_id,
                        'school_id' => $school_id,
                        'class_id' => $class_id,
                        'status' => 'absent',
                    ]);
                }
            }
        } else {
            foreach ($student_ids as $student_id) {

                Attendance::create([
                    'student_id' => $student_id,
                    'school_id' => $school_id,
                    'class_id' => $class_id,
                    'status' => 'absent',
                ]);
            }

            return redirect()->route('teacher.homepage')->with('success', 'Attendence added successfully.');
        }

        return redirect()->route('teacher.homepage')->with('success', 'Attendence added successfully.');
    }



    public function attendence_history()
    {
        $teacher = $this->getLoggedInTeacherInfo();
        $class_name = Classes::where(['school_id' => $teacher->school_id, 'class_teacher_id' => $teacher->staff->id])->pluck('name')->first();
        // dd($class);


        $attendance_records = Attendance::with('student')->where('school_id', $teacher->school_id)
            ->orderBy('created_at', 'desc')
            ->get()
            // ->groupBy('created_at');
            ->groupBy(function ($attendance) {
                // Group by date (created_at) in Y-m-d format
                return $attendance->created_at->format('Y-m-d');
            })
            ->map(function ($groupedRecords) {
                // Initialize counters for present and absent
                $presentCount = 0;
                $absentCount = 0;

                // Count occurrences of each status
                foreach ($groupedRecords as $record) {
                    if ($record->status === 'present') {
                        $presentCount++;
                    } elseif ($record->status === 'absent') {
                        $absentCount++;
                    }
                }

                // Return an array with date, present count, and absent count
                return [
                    'date' => $groupedRecords[0]->created_at,
                    'present_count' => $presentCount,
                    'absent_count' => $absentCount,
                ];
            });




        // dd($attendance_records);

        return view('teacher.attendance_history_page', compact('teacher', 'class_name', 'attendance_records'));
    }



    public function filterRecordsByDate(Request $request)
    {

        $teacher = $this->getLoggedInTeacherInfo();
        $class_name = Classes::where(['school_id' => $teacher->school_id, 'class_teacher_id' => $teacher->staff->id])->pluck('name')->first();

        // Assuming you have two dates to filter by
        // Parse the start and end dates from the request input
        // dd($request->all());



        // Debug the parsed dates
        // dd($startDate, $endDate);
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if (!$startDate || !$endDate) {
            // dd('Please provide both start and end dates');
            return redirect()->route('teacher.attendence_history');
        } else {
            $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();
        }

        $attendance_records = Attendance::with('student')
            ->where('school_id', $teacher->school_id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($attendance) {
                // Group by date (created_at) in Y-m-d format
                return $attendance->created_at->format('Y-m-d');
            })
            ->map(function ($groupedRecords) {
                // Initialize counters for present and absent
                $presentCount = 0;
                $absentCount = 0;

                // Count occurrences of each status
                foreach ($groupedRecords as $record) {
                    if ($record->status === 'present') {
                        $presentCount++;
                    } elseif ($record->status === 'absent') {
                        $absentCount++;
                    }
                }

                // Return an array with date, present count, and absent count
                return [
                    'date' => $groupedRecords[0]->created_at,
                    'present_count' => $presentCount,
                    'absent_count' => $absentCount,
                ];
            });


        return view('teacher.attendance_history_page', compact('teacher', 'class_name', 'attendance_records'));
    }
}
