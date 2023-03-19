<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\CommentCreateRequest;
use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    public function create(): string
    {
        return view('posts.detail-post');
    }

    public function store(BlogPostCreateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = $request->input();
        $post = (new BlogPost())->create($data);

        if($post){
            return redirect()->route('news.index')
                ->with('info','Post succesfully created');
        } else {
            return back()
                ->withErrors(['info','Validation errors'])
                ->withInput();
        }

    }

    public function comment(Request $request, $post_id): RedirectResponse
    {
        $data = $request->input();
        $comment = new Comment();
        $comment->body = $data["comment-$post_id"];;
        $comment->post_id = $post_id;
        $comment->user_id = auth()->id();
        $comment->save();

        return back()->with('info', 'Comment added successfully.');

    }

}
