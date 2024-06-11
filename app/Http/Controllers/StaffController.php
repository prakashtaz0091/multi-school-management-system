<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\School;
use App\Models\Staff;
use App\Models\User;
use App\Rules\NcellNTCNumberCheck;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth_school_id = Auth::user()->school_id;

        $staffs = School::find($auth_school_id)->users->where('role', 'staff');



        return view('school_admin.staffs', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('school_admin.staff_create');
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
            'salary' => 'required|numeric',
            'staff_type' => 'required',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
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
            'role' => 'staff',
            'school_id' => Auth::user()->school_id,
            // 'image' => 'default.png',
        ]);

        if ($request->has('profile_pic')) {
            // dd($request->profile_pic);
            $user->update(['image' => $request->profile_pic->store('profile_pics', 'public')]);
        }


        $staff = Staff::create(
            [
                'user_id' => $user->id,
                'salary' => $request->salary,
                'staff_type' => $request->staff_type,
            ]
        );


        return redirect()->route('school_admin.staffs.index')->with('success', 'Staff created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $user_id)
    {

        $user = User::with('staff')->find($user_id);

        return view('school_admin.staff_detail', compact('user'));
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
    public function destroy(string $user_id)
    {
        $user = User::with('staff')->findOrFail($user_id);
        $user->delete();

        return redirect()->route('school_admin.staffs.index')->with('success', 'Staff deleted successfully!');
    }
}
