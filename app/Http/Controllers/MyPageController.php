<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class MyPageController extends Controller
{
    public function index(Request $request)
    {

        return view("mypage.my_page");

    }

    public function store()
    {

    }
}
