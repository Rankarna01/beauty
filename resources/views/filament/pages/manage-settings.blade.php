<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}

        <div class="flex justify-end pt-4">
            <x-filament::button type="submit" size="lg" icon="heroicon-m-check">
                Simpan Perubahan Pengaturan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
