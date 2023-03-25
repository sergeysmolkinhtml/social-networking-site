<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{

    public function changeToEmployer($id): RedirectResponse
    {
        return redirect()->back()->with('info', 'Changed to employer profile');
    }
}
