<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-1">
            <div class="text-lg font-bold">
                {{ now()->isoFormat('YYYY年M月D日（ddd）') }}
            </div>

            <div class="text-sm text-gray-500">
                {{ now()->format('H:i') }}
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
