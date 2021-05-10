<div>

    <x-jet-form-section submit="save">
        <x-slot name="title">
            Customer Info
        </x-slot>

        <x-slot name="description">
            Edit customer info here
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="Name" />
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="customer.name"/>
                <x-jet-input-error for="name" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                Save
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
</div>
