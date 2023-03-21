
<div>
    <form method="POST" action="{{ route('register') }}" novalidate >
        @csrf

        <!-- Step 1-->
        <div class="{{$currentStep !=1 ? 'hidden' : ''}}" id="step-1">
            <div>
                <x-label for="name" value="{{ __('First Name') }}"/>
                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" :value="old('name')" required
                         autofocus
                         autocomplete="name"/>
                @error('name')<span class="text-red-590"> {{$message}} </span>@enderror
            </div>

            <div class="mt-4">
                <x-label for="last_name" value="{{ __('Last Name') }}"/>
                <x-input id="last_name" class="block mt-1 w-full" type="text" wire:model="last_name"
                         :value="old('last_name')"
                         required autofocus autocomplete="name"/>
                @error('last_name')<span class="text-red-590"> {{$message}} </span>@enderror
            </div>

            <select wire:model="gender"
                    class="mt-4 border-gray-300 focus:border-blue-300 focus:ring focus:ring-opacity-50 rounded-md shadow-sm @error('gender') is-invalid @enderror">

                <option value="">{{ __('Gender') }}</option>
                <option value="m" {{old('gender') === 'm' ? 'selected' : ''}}> Male</option>
                <option value="f" {{old('gender') === 'f' ? 'selected' : ''}}> Female</option>
            </select>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4" wire:click="firstStepSubmit" type='button'>
                    {{ __('Next Step') }}
                </x-button>
            </div>

        </div>
        <!-- /Step 1-->


        <!-- Step 2-->
        <div class="{{$currentStep != 2 ? 'hidden' : ''}}" id="step-2">
            <div class="mt-4">
                <x-label for="nickname" value="{{ __('Nickname') }}"/>
                <x-input id="nickname" class="block mt-1 w-full" type="text" wire:model="nickname"
                         :value="old('nickname')"
                         required
                         autocomplete="nickname"/>
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" class="block mt-1 w-full" type="email" wire:model="email"
                         :value="old('email')"
                         required
                         autocomplete="username"/>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" class="block mt-1 w-full" type="password" wire:model="password" required
                         autocomplete="new-password"/>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"/>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                         wire:model="password_confirmation"
                         required autocomplete="new-password"/>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox wire:model="terms" id="terms" required/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4" wire:click="submitForm">
                    {{ __('Register') }}
                </x-button>
                <button  type="button" wire:click="back(1)"
                         class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Back
                </button>
            </div>
        </div><!-- /Step 2-->
    </form>
</div>
