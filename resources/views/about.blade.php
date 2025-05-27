<x-app-layout>
    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ __('about.title') }}</h1>

        <!-- Description -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <p class="text-gray-800 dark:text-gray-200">
                <strong>WonderUA</strong> {{ __('about.description') }}
            </p>
        </div>

        <!-- Features -->
        <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Функціонал сайту</h2>
            <ul class="list-disc list-inside text-gray-800 dark:text-gray-200 space-y-2">
                <li><strong>{{ __('about.explore_cities_title') }}</strong> {{ __('about.explore_cities_description') }}
                </li>
                <li><strong>{{ __('about.add_places_title') }}</strong> {{ __('about.add_places_description') }}</li>
                <li><strong>{{ __('about.support_local_businesses_title') }}</strong>
                    {{ __('about.support_local_businesses_description') }}</li>
                <li><strong>{{ __('about.interactive_map_title') }}</strong>
                    {{ __('about.interactive_map_description') }}</li>
                <li><strong>{{ __('about.ratings_reviews_title') }}</strong>
                    {{ __('about.ratings_reviews_description') }}</li>
            </ul>
        </div>

        <!-- Image -->
        <div class="flex justify-center">
            <img src="{{ asset('assets/img/ua-banner.jpg') }}" alt="WonderUA Banner" class="rounded-lg shadow-md w-1/2">
        </div>
    </div>
</x-app-layout>
