<x-filament::page>
    <h2 class="text-xl font-bold mb-6">Disk Usage Overview</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-filament::card>
            <h3 class="text-lg font-semibold">Disk Space Used</h3>
            <p class="text-2xl">{{ $this->formatSize($diskUsed) }}</p>
            <p>{{ $usedPercentage }}%</p>
        </x-filament::card>

        <x-filament::card>
            <h3 class="text-lg font-semibold">Disk Space Free</h3>
            <p class="text-2xl">{{ $this->formatSize($diskFree) }}</p>
        </x-filament::card>

        <x-filament::card>
            <h3 class="text-lg font-semibold">Total Disk Space</h3>
            <p class="text-2xl">{{ $this->formatSize($diskTotal) }}</p>
        </x-filament::card>
    </div>
</x-filament::page>
