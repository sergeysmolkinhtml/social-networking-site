@extends('base')

@section('content')
    <div class="p-16 items-center">
        <ul id="notifications">
        </ul>
        notifications
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            const pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
                cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
            });

            const channel = pusher.subscribe('private-notifications');
            channel.bind('App\\Events\\NewNotification', function(data) {
                const li = document.createElement("li");
                li.innerText = data.message;
                document.getElementById("notifications").appendChild(li);
            });
        </script>
        <div class="p-8 bg-white shadow mt-24">
            <div class="grid grid-cols-1 md:grid-cols-3">
                <div class="grid grid-cols-3 text-center order-last md:order-first mt-20 md:mt-0">
                    <a href="{{route('friends.index',auth()->user()->getNicknameOrName() )}}"><div><p class="font-bold text-gray-700 text-xl">
                                @if(!auth()->user()->friends()->count())
                                    0
                                @else
                                    {{auth()->user()->friends()->count()}}
                                @endif
                            </p>
                            <p class="text-gray-400">Friends</p></div></a>
                    <div><p class="font-bold text-gray-700 text-xl">10</p>
                        <p class="text-gray-400">Photos</p></div>
                    <div><p class="font-bold text-gray-700 text-xl">89</p>
                        <p class="text-gray-400">Comments</p></div>
                </div>
                <div class="relative">
                    @isset($path)
                        <img src="{{asset('/storage/' . $path) }}" class="w-48 h-48 bg-indigo-100 mx-auto rounded shadow-2xl absolute inset-x-0 top-0 -mt-24 flex items-center justify-center text-indigo-500" alt="" >
                    @endisset
                    <form action="{{route('pfp.upload',auth()->user()->getNicknameOrName() )}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="image">
                        <button type="submit">send</button>
                    </form>
                </div>
                <div class="space-x-8 flex justify-between mt-32 md:mt-0 md:justify-center">
                    <button href="{{route('dialogues.dash',auth()->user()->name)}}" class="text-white py-2 px-4 uppercase rounded bg-blue-400 hover:bg-blue-500 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        <a href="{{route('dialogues.dash',auth()->user()->getNicknameOrName()) }}">
                            Message
                        </a>
                    </button>

                    <button class="text-white py-2 px-4 uppercase rounded bg-gray-700 hover:bg-gray-800 shadow hover:shadow-lg font-medium transition transform hover:-translate-y-0.5">
                        Connect
                    </button>
                </div>
            </div>
            <div class="mt-20 text-center border-b pb-12"><h1 class="text-4xl font-medium text-gray-700">
                    first last name,
                    <span class="font-light text-gray-500">age</span></h1>
                <p class="font-light text-gray-600 mt-3">city</p>
                <p class="mt-8 text-gray-500">job title</p>
                <p class="mt-2 text-gray-500">education</p></div>
            <div class="mt-12 flex flex-col justify-center"><p class="text-gray-600 text-center font-light lg:px-16">
                    descrtiption
                </p>
                <button class="text-indigo-500 py-2 px-4  font-medium mt-4"> Show more</button>
            </div>
        </div>
    </div>

@endsection
