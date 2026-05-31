<x-filament-panels::page>
    <form wire:submit="send">
        {{ $this->form }}

        <div class="mt-6 flex justify-end gap-3">
            <x-filament::button type="submit" icon="heroicon-o-paper-airplane">
                Enviar
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
