<x-app-layout>
    <div class="gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>


        @if (session('success'))
            <x-pop-up message="{{ session('success') }}" />
        @endif



        <!-- Banner -->
        <x-home.banner />

        <!-- Map -->
        <x-map :regions="$regions" />

        <!-- Popular Locations -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">Найбільш популярні</h2>
        <div class="grid grid-cols-4 gap-6">
            {{-- @if (count($topRatedLocations) == 0) --}}
            {{-- <div --}} {{--
                class='w-full flex items-center justify-center h-48 text-center text-xl font-semibold text-gray-800 dark:text-gray-200 '> --}}
            {{-- Популярні локації відсутні --}}
            {{-- </div> --}}
            {{-- @else --}}
            @foreach ($topRatedLocations as $location)
                <x-location-card :id="$location->id" :image="asset('uploads/' . $location->image_path)" :title="$location->name" :rating="intval($location->avg_rating) == $location->avg_rating
                    ? intval($location->avg_rating)
                    : number_format($location->avg_rating, 1)" />
            @endforeach
            {{-- @endif --}}
        </div>
        <!-- Recently Added Locations -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">Нові</h2>
        <div class="grid grid-cols-4 gap-6">
            {{-- @if (count($latestLocations) == 0) --}}
            {{-- <div --}} {{--
            class='w-full flex items-center justify-center h-48 text-center text-xl font-semibold text-gray-800 dark:text-gray-200 '> --}}
            {{-- Нові локації відсутні --}}
            {{-- </div> --}}
            {{-- @else --}}
            @foreach ($latestLocations as $location)
                <x-location-card :id="$location->id" :image="asset('uploads/' . $location->image_path)" :title="$location->name" :rating="intval($location->avg_rating) == $location->avg_rating
                    ? intval($location->avg_rating)
                    : number_format($location->avg_rating, 1)" />
            @endforeach
            {{-- @endif --}}
        </div>
    </div>
</x-app-layout>
