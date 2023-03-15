<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $path = $request->file('image')
                        ->store('uploads','public');

        return view('mypage.my_page',compact('path'));
    }
}
