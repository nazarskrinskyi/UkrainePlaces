<x-app-layout>
    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $location->name }}</h1>

        <!-- Image and Map -->
        <div class="flex gap-6">
            <div class="w-1/2">
                <img src="{{ asset('uploads/' . $location->image_path) }}" alt="Location Image"
                    class="w-full rounded-lg shadow-md">
            </div>
            <div class="w-1/2 bg-gray-100 dark:bg-gray-800 p-2 rounded-lg shadow-md flex flex-col gap-1">
                <div id="map" class="w-full h-full grow"></div>
                <div class='w-full flex '>
                    <div class="w-1/2">
                        <p class="text-gray-800 dark:text-gray-200 text-center">Широта: {{ $location->latitude }}</p>
                    </div>
                    <div class="w-1/2">
                        <p class="text-gray-800 dark:text-gray-200 text-center">Довгота: {{ $location->longitude }}</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md overflow-hidden ">
            <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Опис</h2>
            <div
                class="text-gray-800 dark:text-gray-200 break-words border border-gray-400 dark:border-gray-600 p-4 rounded-lg">
                {!! $location->description !!}</div>
        </div>

        <!-- Comments -->
        <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">COMMENTS</h2>
            <div class="space-y-4">
                {{-- @foreach ($location->comments as $comment)
        <div class="p-2 bg-white dark:bg-gray-900 rounded-lg shadow-md">
          <p class="text-gray-700 dark:text-gray-300">{{ $comment->text }}</p>
          <span class="text-xs text-gray-500 dark:text-gray-400">By {{ $comment->author }}</span>
        </div>
        @endforeach --}}
            </div>
        </div>


        <!-- Location Footer -->
        <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300">
            <span>Автор: {{ $user_name }}</span>
            @if (Auth::user() && Auth::user()->id == $location->user_id)
                <div class="space-x-4">
                    <x-secondary-button class="hover:underline"><a
                            href="{{ route('location.edit.form', $location->id) }}">Редагувати</a></x-secondary-button>
                </div>
            @endif
        </div>
    </div>

    <style>
        .dark .leaflet-layer,
        .dark .leaflet-control-zoom-in,
        .dark .leaflet-control-zoom-out {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
        }
    </style>

    <script>
        const map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;
        @if (isset($location) && !empty($location->latitude))
            const [lat, lng] = ["{{ $location->latitude }}", "{{ $location->longitude }}"];
            marker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 12);
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        @endif
    </script>

</x-app-layout>
