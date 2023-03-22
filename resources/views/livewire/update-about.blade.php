<x-form-section submit="updateAbout">
    <x-slot name="title">
        About Me
    </x-slot>

    <x-slot name="description">
        Something about you
    </x-slot>

    <x-slot name="form">

        <div class="col-span-6 sm:col-span-4">
            <x-label for="status_description" value="About me"/>
            <textarea id="status_description" class="h-24 resize-none border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-400 focus:border-blue-300 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full"
            wire:model.defer="state.status_description"
            autocomplete="status_description"></textarea>
          <x-input-error for="status_description" class="mt-2"/>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{__('Saved')}}
        </x-action-message>

        <x-button wire:loading.attr="disabled">
            {{__('Save')}}
        </x-button>

    </x-slot>

</x-form-section>
