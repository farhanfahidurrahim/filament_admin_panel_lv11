<x-filament::page>
    <h2>Change Your Password</h2>

    <form wire:submit.prevent="save">
        {{ $this->form }}

        <div class="flex items-center justify-end mt-4">
            <x-filament::button type="submit">Change Password</x-filament::button>
        </div>
    </form>
</x-filament::page>
