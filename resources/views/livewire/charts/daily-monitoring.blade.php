<div wire:poll.5000ms class="w-full max-w-full p-3 text-center bg-white border border-gray-200 rounded-lg shadow-md sm:p-2 md:p-4 dark:bg-gray-800 dark:border-gray-700">
    {{-- <span class="font-bold">TODAY:</span> {{ now()->timezone('Asia/Manila')->toDayDateTimeString() }} --}}
    <p class="font-bold">Daily Average River Level</p>
    <div class="h-96">
        <livewire:livewire-area-chart
            key="{{ $dailyAreaChartModel->reactiveKey() }}"
            :area-chart-model="$dailyAreaChartModel"
        />
    </div>
</div>