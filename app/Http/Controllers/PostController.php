<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function post(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request,[
           'title' => 'required|max:10',
           'content_raw' => 'required',
        ]);


        Auth::user()->posts()->create([
            'title'        => $request->input('title'),
            'content_raw'  => $request->input('content_raw'),
            'published_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()
            ->route('news.index')
            ->with('info','Post successfully added');
    }
}
