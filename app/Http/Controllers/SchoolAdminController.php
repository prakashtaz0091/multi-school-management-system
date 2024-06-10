<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolAdminController extends Controller
{
    public function dashboard()
    {



        $auth_id = Auth::user()->id;
        $user_with_school = User::with('school')->find($auth_id);

        // dd($user_with_school);

        return view('school_admin.dashboard', compact('user_with_school'));
    }
}
