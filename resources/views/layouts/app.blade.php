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

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            #map { height: 500px; width: 100%; }
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
        <div class="main-container">
            <div class="editor-container editor-container_classic-editor" id="editor-container">
                <div class="editor-container__editor"><div id="editor"></div></div>
            </div>
        </div>

        <h2>Оберіть місце на карті</h2>
        <div id="map"></div>
        <form action="{{ route('save.location') }}" method="POST">
            @csrf
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="submit">Зберегти</button>
        </form>

        Це копія розмови між ChatGPT й анонімним користувачем.
        Ви сказали:
        мені треба інтигрувати карту на сайт безкоштовно типу юзер обере точку і при сабміті форми на беці збережуться координати обрані юзером на карті моджеш цн реаліщувати на ларавел?
        Програма ChatGPT сказала:

        Так, можна реалізувати інтеграцію карти на Laravel, використовуючи Leaflet.js для фронтенду та стандартні можливості Laravel для бекенду.
        Кроки реалізації
        1. Додаємо карту на фронтенд (Blade + Leaflet.js)

        У файлі resources/views/map.blade.php:

        <!DOCTYPE html>
        <html lang="uk">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Карта</title>
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <style>
                #map { height: 500px; width: 100%; }
            </style>
        </head>
        <body>

        <h2>Оберіть місце на карті</h2>
        <div id="map"></div>
        <form action="{{ route('save.location') }}" method="POST">
            @csrf
            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">
            <button type="submit">Зберегти</button>
        </form>

        <script>
            const map = L.map('map').setView([49.8397, 24.0297], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            let marker;

            map.on('click', function (e) {
                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
                document.getElementById('latitude').value = e.latlng.lat;
                document.getElementById('longitude').value = e.latlng.lng;
            });
        </script>

        <!-- Load CKEditor Script -->
        <script src="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.umd.js" crossorigin></script>
    </main>
</div>
</body>
</html>
