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
@endsection
