<?php

namespace App\Http\Controllers;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\NcellNTCNumberCheck;

class GuardianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $guardians = User::where(['school_id' => $user->school_id, 'role' => 'guardian'])->get();

        return view('school_admin.guardians', compact('guardians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school_admin.guardian_create');
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
        ]);

        // dd(request()->all());
        $auth_school_id = Auth::user()->school_id;
        $user = User::create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt("default"),
            'dob' => $request->dob,
            'address' => $request->address,
            'phone' => $request->contact_number,
            'gender' => $request->gender,
            'role' => 'guardian',
            'school_id' => $auth_school_id,
            // 'image' => 'default.png',
        ]);

        if ($request->has('profile_pic')) {
            // dd($request->profile_pic);
            $user->update(['image' => $request->profile_pic->store('profile_pics', 'public')]);
        }


        $guardian = Guardian::create(
            [
                'user_id' => $user->id,

                'school_id' => $auth_school_id
            ]
        );


        return redirect()->route('school_admin.guardians.index')->with('success', 'Guardian created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guardian = User::where('role', 'guardian')->findOrFail($id);

        // dd($guardian->guardian->students);
        return view('school_admin.guardians_detail', compact('guardian'));
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
