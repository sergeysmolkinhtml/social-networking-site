@extends('base')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
@section('content')
    <div class="flex items-center justify-end mt-4">
        @guest
            <a href="{{route('auth.google')}}" class="text-white bg-indigo-600 hover:bg-indigo-500 px-10 py-4 w-full rounded-md text-center transition duration-150 ease-in-out" >
                Log In with Google
            </a>
        @endguest
    </div>
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">New's Page</h1>
        </div>
    </header>

    <main>

        <!-- component -->
        <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Post</div>
        <style>
            body {background:white !important;}
        </style>
        <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
            <input name="title" class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none {{$errors->has('title') ? 'is-invalid': ''}}" spellcheck="false" placeholder="Title" type="text">

            <textarea name="content_raw" class="description bg-gray-100 sec p-3 h-60 border border-gray-300 outline-none {{$errors->has('content_raw') ? 'is-invalid': ''}}" spellcheck="false" placeholder="Describe everything about this post here"></textarea>

            <!-- icons -->
            <div class="icons flex text-gray-500 m-2">
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" /></svg>
                <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
            </div>
            <!-- buttons -->
            <div class="buttons flex">
                <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">Cancel</div>
                <form action="{{route('blog.post')}}" method="post">
                    @csrf
                    <button type="submit" class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">
                        Post
                    </button>
                </form>
            </div>
        </div>

    </main>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Recommendations</h1>
        </div>
    </header>

    <main>
    @if(!$posts->count())
            <form action="{{route('blog.post')}}" method="post">
                @csrf
                <button type="submit" class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">
                    Talk something
                </button>
            </form>
    @else
        @foreach($posts as $post)
        <div class="bg-white py-24 sm:py-32">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$post->title}}</h2>

                    <div class="flex items-center">
                        <button class="flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 hover:bg-pink-500 hover:text-white transition-colors duration-300 focus:outline-none focus:bg-pink-500 focus:text-white"
                            aria-label="Like"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                            </svg>
                        </button>
                        <p class="ml-3 text-gray-700">Нравится</p>
                    </div>
                </div>
                <div class="mx-auto mt-10 grid max-w-2xl grid-cols-1 gap-y-16 gap-x-8 border-t border-gray-200 pt-10 sm:mt-16 sm:pt-16 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <article class="flex max-w-xl flex-col items-start justify-between">
                        <div class="flex items-center gap-x-4 text-xs">
                            <time datetime="2020-03-16" class="text-gray-500">date publication</time>
                            <a href="#" class="relative z-10 rounded-full bg-gray-50 py-1.5 px-3 font-medium text-gray-600 hover:bg-gray-100">category</a>
                        </div>
                        <div class="group relative">
                            <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                <a href="#">
                                    <span class="absolute inset-0"></span>
                                    first words from description
                                </a>
                            </h3>
                            <p class="mt-5 text-sm leading-6 text-gray-600 line-clamp-3">{{$post->content_raw}}</p>
                        </div>

                        <div class="relative mt-8 flex items-center gap-x-4">
                           <a href="">

                               <img src="{{$post->user->profilePictureUrl()}}" alt="" class="h-10 w-10 rounded-full bg-gray-50">
                           </a>
                            <div class="text-sm leading-6">
                                <p class="font-semibold text-gray-900">
                                    <a href="{{route('user_profile.index',$post->user->nickname)}}">
                                        <span class="absolute inset-0"></span>
                                        Mauthor
                                    </a>
                                </p>
                                <p class="text-gray-600">job title</p>
                            </div>
                        </div>
                    </article>

                    <!-- More posts... -->
                </div>
            </div>
        </div>
    </main>
    @endforeach
    @endif
@endsection
