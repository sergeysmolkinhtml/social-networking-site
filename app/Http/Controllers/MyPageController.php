<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('mypage.my_page');
    }

    public function store()
    {

    }
}
