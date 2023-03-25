<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function changeToEmployer(): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isEmployer($user)){
            return redirect()->back()->with('info','Already employer');
        } else {
            Auth::user()->employer = 1;
            Auth::user()->save();
        }

       return redirect()->back()->with('info', 'Changed to employer profile');
    }

}
