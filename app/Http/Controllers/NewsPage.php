<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\BlogPost;
use App\Models\Reply;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsPage extends Controller
{

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (Auth::check()) {
            $posts = BlogPost::with('user','likes')->where(function ($query) {
                return $query->where('user_id', Auth::user()->id)
                       ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
                    })->orderBy('created_at', 'asc')
                      ->paginate(1);

            $firstPost = $posts->first();

            return view('news.news', compact(
                'posts',
                'firstPost'));
        }

        return view('auth.login');
    }


}
