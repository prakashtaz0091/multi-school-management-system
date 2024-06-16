<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Shankhadev\Bsdate\BsdateFacade;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::where('school_id', Auth::user()->school_id)->orderBy('created_at', 'desc')->get();
        return view('school_admin.exams', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::where('school_id', Auth::user()->school_id)->get();

        // dd(now()->year);
        $year_bs = BsdateFacade::eng_to_nep(now()->year, now()->month, now()->day)['year'];
        $year_bs = html_entity_decode($year_bs, ENT_QUOTES, 'UTF-8');


        return view('school_admin.exam_create', compact('classes', 'year_bs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'exam_type' => 'required',
        ]);

        $exam = Exam::create([
            'name' => $request->name,
            'exam_type' => $request->exam_type,
            'school_id' => Auth::user()->school_id,
        ]);
        // dd("hello");
        return redirect()->route('school_admin.exams.addSubjects')->with('success', "Exam added successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // dd($id);
        $exam = Exam::with('subjects')->find($id);
        // dd($exam);
        return view('school_admin.exam_show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('school_admin.exam_edit');
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


    public function getSubjectsForClass(Request $request, String $class_id)
    {
        // dd($class_id);
        $classes = Classes::with('subjects')->where('id', $class_id)->first();

        // dd($subjects->subjects);
        return response()->json($classes, 200);
    }


    public function addSubjects(string $exam_id)
    {
        $exam = Exam::find($exam_id);
        $classes = Classes::where('school_id', Auth::user()->school_id)->get();

        // dd(now()->year);
        $year_bs = BsdateFacade::eng_to_nep(now()->year, now()->month, now()->day)['year'];
        $year_bs = html_entity_decode($year_bs, ENT_QUOTES, 'UTF-8');


        return view('school_admin.exam_add_subjects', compact('exam', 'classes', 'year_bs'));
    }


    public function storeSubjects_Exam(Request $request, String $exam_id)
    {
        // dd($request->all());
        $exam = Exam::find($exam_id);
        $exam->subjects()->sync($request->subjects);
        return redirect()->route('school_admin.exams.index')->with('success', "Subjects added successfully to exam {$exam->name}.");
    }
}
