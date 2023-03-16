@extends('base')

@section('content')
    <div class="p-16">
        <p class="italic font-bold text-5xl"> Search results for: {{request()->input('query')}} </p>
        @if(!$users->count())
            no users found
        @else
            @foreach($users as $user)
                @include('mypage.partials.userblock')
            @endforeach
        @endif
    </div>
@endsection

