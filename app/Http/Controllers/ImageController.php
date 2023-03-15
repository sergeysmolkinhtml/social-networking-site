<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function upload(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $path = $request->file('image')->store('uploads','public');

        $img = Image::make($request->file('image'));

        Cache::put($path,$img->encode('jpg')->__toString(),60);

        $cachedImg = Cache::get($path);
        $img = Image::make($cachedImg);

        return view('mypage.my_page',compact('path'));
    }
}
