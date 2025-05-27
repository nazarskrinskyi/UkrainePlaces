<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white p-8 shadow-md rounded-lg dark:bg-gray-800">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-200">
            {{ isset($location) ? __('location.edit_title') : __('location.create_title') }}
        </h2>


        <form
            action="{{ isset($location) ? UrlHelper::localizedRoute('location.update', $location) : UrlHelper::localizedRoute('location.store') }}"
            method="POST" enctype="multipart/form-data" class="space-y-6" id="location">
            @csrf
            @if (isset($location))
                @method('PUT')
            @endif

            <div>
                <x-input-label for="name">{{ __('location.name') }}:</x-input-label>
                <x-text-input class='w-full p-3' type="text" name="name" id="name"
                    value="{{ old('name', $location->name ?? '') }}" />
            </div>

            <div>
                <x-input-label for="editor">{{ __('location.description') }}:</x-input-label>
                <x-text-input type="hidden" name="description" id="description"
                    value="{{ old('description', $location->description ?? '') }}" />
                <div id="editor"
                    class="ck-content border rounded-lg p-2 min-h-[200px] border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ">
                    {!! old('description', $location->description ?? '') !!}
                </div>
            </div>

            <div>
                <x-input-label for="city_id">{{ __('location.region') }}:</x-input-label>
                <select name="city_id" id="city_id"
                    class="w-full p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}"
                            {{ isset($location) && $location->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-text-input class='w-full' type="hidden" name="user_id" value="{{ auth()->id() }}" />

            <div>
                <h3 class="block text-gray-700 mb-2 dark:text-white">{{ __('location.map') }}:</h3>
                <div id="map" class="h-72 w-full border rounded-lg" style="width: 100%"></div>

                <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="latitude">{{ __('location.latitude') }}:</x-input-label>
                        <x-text-input class='w-full p-3' type="text" id="latitude" name="latitude"
                            value="{{ old('latitude', $location->latitude ?? '') }}" readonly />
                    </div>
                    <div>
                        <x-input-label for="longitude">{{ __('location.longitude') }}:</x-input-label>
                        <x-text-input class='w-full p-3' type="text" id="longitude" name="longitude"
                            value="{{ old('longitude', $location->longitude ?? '') }}" readonly />
                    </div>
                </div>
            </div>

            <div>
                <x-input-label for="image">{{ __('location.image') }}:</x-input-label>
                <x-text-input class='w-full p-3' type="file" name="image_path" id="image" />
                @if (isset($location) && $location->image_path)
                    <img src="{{ asset('uploads/' . $location->image_path) }}" class="mt-3 h-32 w-32 object-cover">
                @endif
            </div>

            <x-primary-button type="submit" class='w-full flex justify-center py-3'>
                {{ isset($location) ? __('location.update') : __('location.create') }}
            </x-primary-button>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.css" crossorigin>
    <script src="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.umd.js" crossorigin></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        .dark .leaflet-layer,
        .dark .leaflet-control-zoom-in,
        .dark .leaflet-control-zoom-out {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
        }
    </style>

    <script>
        const map = L.map('map').setView([48.3794, 31.1656], 6);
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

        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>

</x-app-layout>
