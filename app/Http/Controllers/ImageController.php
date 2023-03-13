<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('mypage.my_page');
    }
}
