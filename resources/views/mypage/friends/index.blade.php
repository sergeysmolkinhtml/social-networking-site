@extends('base')

@section('content')
    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Friends</h1>
        </div>
    </header>

    <main>
        @foreach($friends as $friendUser)
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div
                    class="w-full max-w-sm bg-white border border-w-200 rounded-lg shadow">
                    <div class="flex justify-end px-4 pt-4">
                        <button id="dropdownButton" data-dropdown-toggle="dropdown"
                                class="inline-block text-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm p-1.5"
                                type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown"
                             class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export
                                        Data</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Delete
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex flex-col items-center pb-10">
                        <img src="" class="w-24 h-24 mb-3 rounded-full shadow-lg" alt="Bonnie image"/>
                        <a href="{{route('user_profile.index', $friendUser->getNicknameOrName())}}">
                            <h5 class="mb-1 text-xl font-medium text-gray-900">{{$friendUser->getFullNameAttribute()}}</h5>
                        </a>
                        <span class="text-sm text-gray-500">{{$friendUser->job_title}}</span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Videocall
                            </a>
                            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                                Message
                            </a>
                            <form action="{{route('friend.delete', $friendUser->nickname) }}" method="post">
                                @csrf
                                <input type="submit" value="Delete" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Friend Requests</h1>
        </div>
    </header>

    <main>
        @foreach($friendsRequests as $friendReq)
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <div class="w-full max-w-sm bg-white border border-w-200 rounded-lg shadow">
                    <div class="flex justify-end px-4 pt-4">
                        <button id="dropdownButton" data-dropdown-toggle="dropdown"
                                class="inline-block text-gray-500 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm p-1.5"
                                type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown"
                             class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                            <ul class="py-2" aria-labelledby="dropdownButton">
                                <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                                </li>
                                <li><a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Export
                                        Data</a></li>
                                <li><a href="#"
                                       class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Delete</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="flex flex-col items-center pb-10"><img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                                                       src="" alt="Bonnie image"/>
                        <a href="{{route('user_profile.index', $friendReq->getNicknameOrName())}}"><h5 class="mb-1 text-xl font-medium text-gray-900">
                                {{$friendReq->getFullNameAttribute()}}
                            </h5>
                        </a>
                        <span class="text-sm text-gray-500">{{$friendReq->job_title}}</span>
                        <div class="flex mt-4 space-x-3 md:mt-6">
                            <a href="{{route('friend.accept',$friendReq->nickname)}}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Accept Request
                            </a>
                            <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200">
                                Message
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </main>

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Pending</h1>
        </div>
    </header>

    <main>
        @foreach($friends as $friend)

            @if(auth()->user()->hasFriendRequestPending( $friend ))
                <p> {{$friend}} is in pending  </p>
            @elseif(auth()->user()->hasFriendRequestReceived( $friend))
                <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Accept
                </a>
            @elseif(auth()->user()->isFriendWith( $friend ))
                <p>{{$friend->name }} friends</p>
            @elseif(auth()->user()->id !== $user->id)
                <a href="{{route('friend.add',$friend->nickname)}}" class="p-16 inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Add friend
                </a>
            @endif

        @endforeach

    </main>
@endsection
