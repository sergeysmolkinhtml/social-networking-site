<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\CommentCreateRequest;
use App\Models\BlogPost;
use App\Models\Reply;
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

    /**
     * @throws ValidationException
     */
    public function comment(Request $request, $post_id): RedirectResponse
    {
        $data = $request->input();

        $this->validate($request,[
            "comment-$post_id"=>'required|string|max:255',
        ]);

        $comment = new Reply();
        $comment->body = $data["comment-$post_id"];;
        $comment->post_id = $post_id;
        $comment->user_id = auth()->id();
        $comment->save();


        return back()->with('info', 'Comment added successfully.');

    }

    public function like($post_id)
    {
        $post = BlogPost::find($post_id);

        if( ! $post) redirect()->route('news.index');

        if( ! Auth::user()->isFriendWith($post->user)) {
          return redirect()->route('news.index');
        }

        if (Auth::user()->hasLikedPost($post)){
            return redirect()->route('news.index');
        }

        $post->likes()->create(['user_id'=>Auth::user()->id]);

        return redirect()->back();

    }



}
