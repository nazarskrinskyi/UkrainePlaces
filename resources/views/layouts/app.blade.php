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
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        #map {
            height: 300px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .map-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #coordinates {
            width: 280px;
            padding: 5px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
          </main>
           <!-- Page Footer -->
           @isset($footer)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $footer }}
                    </div>
                </header>
            @endisset
    <!-- <main>
        <div class="map-container">
            <h2>Інтерактивна карта України</h2>
            <div id="map"></div>
            <input type="text" id="coordinates" readonly placeholder="Координати з'являться тут">
        </div>

        <script>
            const map = L.map('map').setView([48.3794, 31.1656], 6);

            // Додаємо шар OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

            let marker;

            // Додаємо обробник кліку для встановлення маркера
            map.on('click', function(e) {
                const { lat, lng } = e.latlng;

                // Видаляємо попередній маркер, якщо він є
                if (marker) {
                    map.removeLayer(marker);
                }

                // Додаємо новий маркер
                marker = L.marker([lat, lng]).addTo(map);

                // Відображаємо координати у полі вводу
                document.getElementById('coordinates').value = `Широта: ${lat.toFixed(5)}, Довгота: ${lng.toFixed(5)}`;

                // Відправляємо координати на бекенд
                sendCoordinates(lat, lng);
            });

            function sendCoordinates(lat, lng) {
                $.ajax({
                    url: '/api/save-location',  // Замініть на свій URL бекенду
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ latitude: lat, longitude: lng }),
                    success: function(response) {
                        console.log('Координати успішно відправлені!');
                    },
                    error: function(error) {
                        console.error('Помилка при відправці координат:', error);
                    }
                });
            }
        </script>
        <div class="main-container">
            <div class="editor-container editor-container_classic-editor" id="editor-container">
                <div class="editor-container__editor"><div id="editor"></div></div>
            </div>
        </div>

        <!-- Load CKEditor Script -->
        <script src="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.umd.js" crossorigin></script>
    </main> -->
</div>
</body>
</html>
