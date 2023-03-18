@extends('base')

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
@endsection
