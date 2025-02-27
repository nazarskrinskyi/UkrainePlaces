<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.css" crossorigin>

        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

        <style>
            #map {
                height: 500px;
                width: 100%;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

{{--            <!-- Page Heading -->--}}
{{--            @isset($header)--}}
{{--                <header class="bg-white dark:bg-gray-800 shadow">--}}
{{--                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">--}}
{{--                        {{ $header }}--}}
{{--                    </div>--}}
{{--                </header>--}}
{{--            @endisset--}}

{{--            <!-- Page Content -->--}}
{{--            <main>--}}
{{--                {{ $slot }}--}}
{{--            </main>--}}
    <main>
        <h2>Інтерактивна карта України</h2>
        <div id="map"></div>

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            var map = L.map('map').setView([48.3794, 31.1656], 6); // Center of Ukraine

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        </script>

        <div class="main-container">
            <div class="editor-container editor-container_classic-editor" id="editor-container">
                <div class="editor-container__editor"><div id="editor"></div></div>
            </div>
        </div>

        <!-- Load CKEditor Script -->
        <script src="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.umd.js" crossorigin></script>
    </main>
</div>
</body>
</html>
