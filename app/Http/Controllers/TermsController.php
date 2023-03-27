<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('custom_terms.terms');
    }

    public function store(): RedirectResponse
    {
        auth()->user()->update([
           'terms_accepted' => true,
        ]);

        return redirect()->route('news.index');
    }

}
