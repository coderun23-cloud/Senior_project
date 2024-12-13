<div class="space-y-6">
    <x-jet-section-title>
        <x-slot name="title">{{ __('Update Address and Phone Number') }}</x-slot>
        <x-slot name="description">{{ __('Update your address and phone number.') }}</x-slot>
    </x-jet-section-title>

    <x-jet-validation-errors class="mb-4" />

    @if (session()->has('message'))
        <x-jet-success-message class="mb-4">
            {{ session('message') }}
        </x-jet-success-message>
    @endif

    <form wire:submit.prevent="update">
        <div class="space-y-6">
            <div>
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" type="text" class="mt-1 block w-full" wire:model="address" autocomplete="address" />
            </div>

            <div>
                <x-jet-label for="phone_number" value="{{ __('Phone Number') }}" />
                <x-jet-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="phone_number" autocomplete="phone_number" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </div>
    </form>
</div>
