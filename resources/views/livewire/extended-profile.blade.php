<x-form-section submit="updateExtendedProfile">
    <x-slot name="title">
        Extended Profile
    </x-slot>

    <x-slot name="description">
        Specify some things about yourself
    </x-slot>

    <x-slot name="form">
        {{-- Birthday --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="date_of_birth" value="Date of Birth"/>

            @include('livewire.partials.birthday')

        </div>

        {{--Career--}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="job_title" value="Work place: company,grade,position"/>
            <x-input id="job_title" class="block mt-1 w-full" type="text" wire:model.defer="state.job_title" />
            <x-input-error for="job_title" class="mt-2"/>
        </div>

        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{__('Saved')}}
            </x-action-message>

            <x-button wire:loading.attr="disabled">
                {{__('Save')}}
            </x-button>

        </x-slot>

    </x-slot>
</x-form-section>
