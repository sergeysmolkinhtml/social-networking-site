<?php

namespace App\Http\Controllers;

use App\Http\Livewire\UpdateAbout;
use App\Http\Requests\BlogPostCreateRequest;
use App\Http\Requests\CommentCreateRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\BlogPost;
use App\Models\Reply;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $posts = BlogPost::latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {

    }

    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('posts.create');
    }

    public function store(BlogPostCreateRequest $request): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $data = $request->input();
        $data['slug'] = Str::slug($data['title']);

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

    public function update(UpdatePostRequest $request, BlogPost $post)
    {
        $post->update($request->validated());

        return redirect()->route('news.index');
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

    public function upload(Request $request)
    {
        try {
            $post = new BlogPost();
            $post->id = 0;
            $post->exists = true;
            $image = $post->addMediaFromRequest('upload')->toMediaCollection('thumb');

            return response()->json([
                'uploaded' => true,
                'url' => $image->getUrl('thumb')
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'uploaded' => false,
                    'error'    => [
                        'message' => $e->getMessage()
                    ]
                ]
            );
        }
    }


}
