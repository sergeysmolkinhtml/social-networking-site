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

        @include('news.includes.story')
        @include('news.includes.sidebar')

        <div class="heading text-center font-bold text-2xl m-5 text-gray-800">
            <a href="{{route('posts.create')}}">Detail New Post </a>
        </div>

        <form method="post" action="{{route('posts.store')}}">
            <div class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl">
                <label for="title">{{__('Title')}}</label>
                <input name="title"
                       id="title"
                       value="{{old('title')}}"
                       class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none {{$errors->has('title') ? 'is-invalid': ''}}"
                       spellcheck="false" placeholder="..." type="text">

                @if($errors->has('title'))
                    {{$errors->first('title')}}
                @endif


                <label for="content_raw">{{__('Content')}}</label>
                <textarea id="content_raw"
                          class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                          name="content_raw">
                        {{ old('content_raw') }}
                    </textarea>


                @if($errors->has('content_raw'))
                    {{$errors->first('content_raw')}}
                @endif

                <div class="icons flex text-gray-500 m-2">
                    <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <svg class="mr-2 cursor-pointer hover:text-gray-700 border rounded-full p-1 h-7"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    <div class="count ml-auto text-gray-400 text-xs font-semibold">0/300</div>
                </div>
                <!-- buttons -->
                <div class="buttons flex">
                    <div class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto">
                        Cancel
                    </div>
                    <form action="{{route('posts.store')}}" method="post">
                        @csrf
                        <button type="submit"
                                class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">
                            Post!
                        </button>
                    </form>
                </div>
            </div>
        </form>

    </main>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Recommendations</h1>
        </div>
    </header>

    <main>
        @if(!$posts->count())
            <form action="{{route('posts.store')}}" method="post">
                @csrf
                <button type="submit"
                        class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-indigo-500">
                    Talk something
                </button>
            </form>
        @else
            @foreach($posts as $post)

                <section class="bg-white dark:bg-gray-900">
                    <div
                        class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-teal-300">{{$post->title}}</h2>
                            <a href="">Edit</a>
                            <p class="mb-4">
                                {{$post->content_raw}}
                            </p>
                            <p>{{$post->user->nickname}}</p>
                            <p>{{$post->created_at->diffForHumans()}}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-8">
                            <img class="w-full rounded-lg"
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png"
                                 alt="office content 1">
                            <img class="mt-4 w-full lg:mt-10 rounded-lg"
                                 src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png"
                                 alt="office content 2">
                        </div>
                        @if($post->user->id !== Auth::user()->id)
                            <button class="flex items-center justify-center space-x-2 text-gray-700 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4c-3.24 0-6.2 1.9-7.55 4.89-.83 1.64-1.4 3.48-1.63 5.36-.24 1.97-.13 3.95.28 5.89.07.33.12.67.17 1h18.06c.05-.33.1-.67.17-1 .41-1.94.52-3.92.28-5.89-.23-1.88-.8-3.72-1.63-5.36C18.2 5.9 15.24 4 12 4z"/>
                                </svg>
                                <span><a href="{{route('posts.like',$post->id)}}">Like</a>

                            </span>
                            </button>
                        @endif
                        <li class="list-inline-item">{{$post->likes->count()}} {{Str::plural('like', $post->likes->count())}}</li>
                    </div>
                </section>

                <!-- Comment Section -->
                <div class="my-2.5">
                    <h2 class="text-2xl font-bold mb-2">Comments</h2>

                    <div class="bg-white rounded-lg overflow-hidden shadow-lg divide-y divide-gray-200">

                        <div class="p-4">
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 rounded-full mr-4 bg-gray-400"></div>
                                <div>
                                    <p class="font-bold"></p>
                                    <p class="text-sm text-gray-600">Posted on March 17, 2023</p>
                                </div>
                            </div>
                            <p class="text-gray-800">Nulla faucibus lectus quis malesuada luctus. Pellentesque commodo
                                id leo sed malesuada. Vestibulum sagittis, lorem non cursus lacinia, mauris mauris
                                vulputate tellus, nec pellentesque velit est vel nisi.</p>
                        </div>

                        <!-- Comment Form -->
                        <form class="ml-10" action="{{route('posts.comment',$post->id)}}" method="POST">
                            @csrf
                            <div class="flex flex-col mb-4">
                                <label class="mb-2 font-bold text-gray-800" for="name">Name</label>
                                <input
                                    class="bg-gray-100 border-2 border-gray-200 p-2 rounded-lg focus:outline-none focus:bg-white"
                                    type="text" name="name" id="name">
                            </div>
                            <div class="flex flex-col mb-4">
                                <label class="mb-2 font-bold text-gray-800" for="comment">Comment</label>
                                <textarea name="comment-{{$post->id}}"
                                          class="bg-gray-100 border-2 border-gray-200 p-2 rounded-lg focus:outline-none focus:bg-white{{$errors->has("comment-{$post->id}") ? 'is-invalid': ''}} "
                                          id="comment"
                                          cols="10"
                                                  rows="2"></textarea>
                                        @if($errors->has("comment-{$post->id}"))
                                            <div class="invalid-feedback">
                                            {{$errors->first("comment-{$post->id}")}}
                                            </div>
                                        @endif
                                    </div>

                                        <button type="submit" class="bg-blue-500 text-teal-300 font-bold py-2 px-4 rounded">
                                            Comment
                                        </button>
                                </form>
                            </div>
                        </div>
    </main>


    <span class="p-16 text-justify">{{$posts->links()}}</span>
    @endforeach
    @endif
@endsection
<style>
    body {
        background: #ffffff;
    }
</style>
@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js">
        ClassicEditor
            .create(document.querySelector('#content_raw')), {
            ckfinder: {
                uploadUrl: '{{ route('upload', ['_token' => csrf_token()]) }}'
            },
        }
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush


