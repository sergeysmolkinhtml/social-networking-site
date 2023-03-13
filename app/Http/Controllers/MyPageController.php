<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index()
    {
        return view('mypage.my_page');
    }

    public function store()
    {
        if(\request()->has('image')){
            $image = \request()->file('image');
            dd($image);
        }
    }
}
