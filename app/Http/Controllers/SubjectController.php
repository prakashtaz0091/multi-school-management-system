<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Staff;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $school_id = Auth::user()->school_id;
        $subjects = Subject::with('classes', 'teacher')->where('school_id', $school_id)->latest('created_at')->simplePaginate(7);


        // dd($subjects);

        return view('school_admin.subjects', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $school_id = Auth::user()->school_id;
        $classes = Classes::where('school_id', $school_id)->get();
        $teachers = Staff::with('user')->where(['school_id' => $school_id, 'staff_type' => 'teacher'])->get();

        return view('school_admin.subject_create', compact('classes', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'subject_code' => 'required|min:2',
            'full_marks' => 'required|numeric',
            'pass_marks' => 'required|numeric',
            'description' => 'nullable',
            'class_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
        ]);
        // dd(request()->all());

        $school_id = Auth::user()->school_id;

        $subject = Subject::create([
            'name' => $request->name,
            'code' => $request->subject_code,
            'description' => $request->description,
            'full_marks' => $request->full_marks,
            'pass_marks' => $request->pass_marks,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
            'school_id' => $school_id,
        ]);

        return redirect()->route('school_admin.subjects.index')->with('success', "Subject '{$subject->name}' added successfully.");
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
        $subject = Subject::with('classes', 'teacher')->find($id);
        $classes = Classes::where('school_id', $subject->school->id)->get();
        $teachers = Staff::with('user')->where(['school_id' => $subject->school->id, 'staff_type' => 'teacher'])->get();
        return view('school_admin.subject_edit', compact('subject', 'classes', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'subject_code' => 'required|min:2',
            'full_marks' => 'required|numeric',
            'pass_marks' => 'required|numeric',
            'description' => 'nullable',
            'class_id' => 'required|numeric',
            'teacher_id' => 'required|numeric',
        ]);
        // dd(request()->all());

        $subject = Subject::find($id);
        $subject->update([
            'name' => $request->name,
            'code' => $request->subject_code,
            'description' => $request->description,
            'full_marks' => $request->full_marks,
            'pass_marks' => $request->pass_marks,
            'class_id' => $request->class_id,
            'teacher_id' => $request->teacher_id,
        ]);

        return redirect()->route('school_admin.subjects.index')->with('success', "Subject '{$subject->name}' updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->route('school_admin.subjects.index')->with('success', "Subject {$subject->name} deleted successfully!");
    }
}
