<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Guardian;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $students = Student::with('user')->where('school_id', Auth::user()->school_id)->simplePaginate(5);
        // dd($students);
        return view('school_admin.students', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Auth::user()->school->classes;
        $guardians = Guardian::with('user')->where('school_id', Auth::user()->school_id)->get();




        return view('school_admin.student_create', compact('classes', 'guardians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:2',
            'address' => 'required|min:3',
            'dob' => 'required',
            'email' => 'required|unique:users|email',
            'contact_number' => ['required', 'numeric', new \App\Rules\NcellNTCNumberCheck],
            'gender' => 'required',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'student_class' => 'required',
            'guardians' => 'required',
        ]);

        // dd(request()->all());

        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt("default"),
            'dob' => $request->dob,
            'address' => $request->address,
            'phone' => $request->contact_number,
            'gender' => $request->gender,
            'role' => 'student',
            'school_id' => Auth::user()->school_id,
            // 'image' => 'default.png',

        ]);


        // foreach ($request->guardians as $guardian_id) {
        //     $student = $user->student()->create([
        //         'class_id' => $request->student_class,
        //         'school_id' => Auth::user()->school_id,
        //     ]);
        //     // dd($guardian_id);
        //     $guardian = Guardian::where('user_id', $guardian_id)->first();
        //     if ($guardian) {
        //         $guardian->students()->attach($student);
        //     }
        // }

        return redirect()->route('school_admin.students.index')->with('success', 'Student admitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
