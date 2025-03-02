<x-app-layout>

    <div class="gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>


        <!-- Banner -->
        <x-home.banner />


        <!-- Map -->
        <x-home.map :regions="$regions"/>

        <!-- Popular Locations -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">Найбільш популярні</h2>
        <div class="flex gap-6 justify-between">
            @foreach($topRatedLocations as $location)
                <x-location-card :image="asset('uploads/' . $location->image_path)" :title="$location->name" :rating="str_replace('0', '', $location->avg_rating)" />
            @endforeach
        </div>
        <!-- Recently Added Locations -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">Нові</h2>
        <div class="flex gap-6 justify-between">
            @foreach($latestLocations as $location)
                <x-location-card :image="asset('uploads/' . $location->image_path)" :title="$location->name" :rating="str_replace('0', '', $location->avg_rating)" />
            @endforeach
        </div>
    </div>
</x-app-layout>
