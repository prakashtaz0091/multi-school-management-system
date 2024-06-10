<?php
// app/Http/ViewComposers/SchoolComposer.php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class SchoolComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $school = Auth::user()->school;
            $view->with('school', $school);
        }
    }
}
