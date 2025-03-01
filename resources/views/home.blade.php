<x-app-layout>
    <!-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ ('Home') }}
        </h2>
    </x-slot> -->

    <div class="gap-6 py-12 container mx-auto">
        <!-- Banner -->
        <x-home.banner />

        <!-- Map -->
        <x-home.map />

        <!-- Locations -->
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 self-start mb-4 pt-4">Найбільш популярні</h2>
        <div class="flex gap-6 flex-wrap justify-between">
            <x-location-card :image="asset('assets/img/ua-banner.jpg')" title="USA" rating="0" />
            <x-location-card :image="asset('assets/img/ua-banner.jpg')" title="United Kingdom" rating="4.5" />
            <x-location-card :image="asset('assets/img/ua-banner.jpg')" title="Ukraine" rating="5" />
        </div>
    </div>
</x-app-layout>