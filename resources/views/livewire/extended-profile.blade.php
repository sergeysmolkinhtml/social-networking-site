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

        {{-- Job title --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="job_title" value="Job title"/>
            <x-input id="job_title" class="block mt-1 w-full" type="text"
                     wire:model.defer="state.job_title"
                     autocomplete="job_title"/>
            <x-input-error for="job_title" class="mt-2"/>
        </div>

        {{-- City --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="city" value="City"/>
            <x-input id="city" class="block mt-1 w-full" type="text"
                     wire:model.defer="state.city"
                     autocomplete="city"/>
            <x-input-error for="city" class="mt-2"/>
        </div>

        {{-- Work formats --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="work_formats" value="Work formats"/>
            <x-input id="work_formats" class="block mt-1 w-full" type="text" wire:model.defer="state.work_formats" />
            <x-input-error for="work_formats" class="mt-2"/>
        </div>

        {{-- Languages --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="languages" value="Languages"/>
            <x-input id="languages" class="block mt-1 w-full" type="text" wire:model.defer="state.languages" />
            <x-input-error for="languages" class="mt-2"/>
        </div>

        {{-- Work experience in years --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="work_experience_years" value="Work experience in years"/>
            <x-input id="work_experience_years" class="block mt-1 w-full" type="text" wire:model.defer="state.work_experience_years" />
            <x-input-error for="work_experience_years" class="mt-2"/>
        </div>

        {{-- Skills --}}

        <div class="col-span-6 sm:col-span-4">
            <x-label for="skills" value="Skills"/>
            <textarea id="skills" class="h-24 resize-none border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 focus:border-blue-300 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full"
                      wire:model.defer="state.skills"
                      autocomplete="skills"></textarea>
            <x-input-error for="skills" class="mt-2"/>
        </div>

        {{-- Achievements --}}
        <div class="col-span-6 sm:col-span-4">
            <x-label for="achievements" value="Achievements"/>
            <textarea id="achievements" class="h-24 resize-none border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 focus:border-blue-300 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full"
                      wire:model.defer="state.achievements"
                      autocomplete="achievements"></textarea>
            <x-input-error for="achievements" class="mt-2"/>
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
