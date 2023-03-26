<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ChangeRoles extends Controller
{
    public function change($status): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isEmployer($user)){

            Auth::user()->employer = 0;
            Auth::user()->save();
            return redirect()->back()->with('info', 'Changed to candidate profile');

        } else {

            Auth::user()->employer = 1;
            Auth::user()->save();
        }

       return redirect()->back()->with('info', 'Changed to employers profile');
    }


}
