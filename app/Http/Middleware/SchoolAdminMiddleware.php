<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SchoolAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // true
        //false -> return
        if (auth()->user()->role == 'school_admin') {
            return $next($request);
        }

        $request->session()->flush();
        Auth::logout();
        return redirect('/')->with('error', 'Unauthorized Access');
    }
}
