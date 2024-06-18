<?php

namespace App\Http\Controllers;

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
}
