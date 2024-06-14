<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classes::where('school_id', Auth::user()->school_id)->orderByRaw("year DESC")->simplePaginate(7);
        // $classes = Classes::where('school_id', Auth::user()->school_id)->simplePaginate(7);

        return view('school_admin.classes', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school_admin.class_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'room_no' => ['nullable', function ($attribute, $value, $fail) {
                $schoolId = Auth::user()->school_id;
                $existingRoomNo = Classes::where(['school_id' => $schoolId, 'room_no' => $value])->exists();

                if ($existingRoomNo) {
                    $fail('Room no is already taken for this school.');
                }
            }],
            'year' => 'required|numeric',
        ]);


        // dd($request->all());

        $classes = Classes::create([
            'name' => $request->name,
            'room_no' => $request->room_no,
            'school_id' => Auth::user()->school_id,
            'year' => $request->year,
        ]);

        return redirect()->route('school_admin.classes.index')->with('success', "Class added successfully.");
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
        $class = Classes::findOrFail($id);
        return view('school_admin.class_edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'room_no' => ['nullable', function ($attribute, $value, $fail) use ($id) {
                $schoolId = Auth::user()->school_id;
                $existingRoomNo = Classes::where(['school_id' => $schoolId, 'room_no' => $value])->first();

                if ($existingRoomNo) {
                    if ($existingRoomNo->id != $id) {
                        $fail('Room no is already taken for this school.');
                    }
                }
            }],
            'year' => 'required|numeric',
        ]);

        $class = Classes::findOrFail($id);
        $class->update([
            'room_no' => $request->room_no,
            'year' => $request->year,
        ]);

        return redirect()->route('school_admin.classes.index')->with('success', "Class updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
