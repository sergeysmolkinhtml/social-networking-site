<div>
    <div>
        @if(Auth::user()->id !== $user->id)
            <p>
                <button wire:click="friendRequest({{$user->id}})"
                        class="inline-flex items-center mt-3 px-4 py-2 bg-lightBlue-500 hover:text-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900  focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                >friend request
                </button>
            </p>
        @endif
    </div>
</div>
