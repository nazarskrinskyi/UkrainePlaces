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
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">
            {{ __('location.most_popular') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($topRatedLocations as $location)
                <x-location-card :id="$location->id" :image="asset('uploads/' . $location->image_path)" :title="$location->name" :rating="intval($location->avg_rating) == $location->avg_rating
                    ? intval($location->avg_rating)
                    : number_format($location->avg_rating, 1)" />
            @endforeach
        </div>
        <!-- Recently Added Locations -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">
            {{ __('location.new_locations') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
            @foreach ($latestLocations as $location)
                <x-location-card :id="$location->id" :image="asset('uploads/' . $location->image_path)" :title="$location->name" :rating="intval($location->avg_rating) == $location->avg_rating
                    ? intval($location->avg_rating)
                    : number_format($location->avg_rating, 1)" />
            @endforeach
        </div>
    </div>
</x-app-layout>
