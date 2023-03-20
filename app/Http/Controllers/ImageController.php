<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function uploadPfp(Request $request,$nickname)
    {
        $user = User::where('nickname',$nickname)->first();

        if (!$user) {
            return redirect()->route('news.index');
        }

        if( Auth::user()->id !== $user->id){
            return redirect()->route('news.index');
        }

        if ($request->hasFile('image'))
        {
            $user->clearPfps($user->id);
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(300,300)
                ->save(public_path($user->getPfpPath($user->id) ) . $filename);

            $user = Auth::user();
            $user->profile_photo_path = $filename;
            $user->save();


        }
        return redirect()->back();
    }

}
