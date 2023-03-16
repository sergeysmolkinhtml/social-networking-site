@extends('base')

@section('content')
    <div class="flex items-center justify-end mt-4">
        @guest
            <a href="{{route('auth.google')}}" class="text-white bg-indigo-600 hover:bg-indigo-500 px-10 py-4 w-full rounded-md text-center transition duration-150 ease-in-out" >
                Log In with Google
            </a>
        @endguest
    </div>

@endsection
