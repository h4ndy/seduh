<x-filament::page>
    <form wire:submit.prevent="transfer">
        {{ $this->form }}
        <x-filament::button type="submit" class="mt-4">
            Transfer Kas
        </x-filament::button>
    </form>
</x-filament::page>
