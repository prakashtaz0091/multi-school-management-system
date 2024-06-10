<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::user()) {
            $url = $this->redirectDash();
            return redirect($url);
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);

        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {

            $url = $this->redirectDash();
            return redirect($url);
        } else {
            return redirect('/')->with('error', 'Username & Password is incorrect');
        }
    }


    private function redirectDash()
    {
        $url = '';

        if (Auth::user()) {
            if (Auth::user()->role == 'teacher') {
                //teacher
                $url = '/teacher/dashboard';
            }
            if (Auth::user()->role == 'school_admin') {
                //school0admin
                $url = '/school-admin/dashboard';
            }
            if (Auth::user()->role == 'student') {
                //studnet
                $url = '/student/home';
            }
            if (Auth::user()->role == 'guardian') {
                //guardian
                $url = '/student/home';
            }
        }

        return $url;
    }



    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
