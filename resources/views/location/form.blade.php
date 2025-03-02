<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">{{ isset($location) ? 'Редагувати локацію' : 'Створити локацію' }}</h2>

        <form action="{{ isset($location) ? route('locations.update', $location) : route('locations.store') }}"
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($location))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Назва локації:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $location->name ?? '') }}"
                       class="w-full p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700">Опис:</label>
                <textarea id="editor" name="description"
                          class="w-full p-2 border rounded-lg">{{ old('description', $location->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label for="city_id" class="block text-gray-700">Місто:</label>
                <select name="city_id" id="city_id" class="w-full p-2 border rounded-lg">
                    @foreach($cities as $city)
                        <option
                            value="{{ $city->id }}" {{ isset($location) && $location->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div class="map-container mb-4">
                <h2>Інтерактивна карта</h2>
                <div id="map" class="h-64 w-full border rounded-lg"></div>
                <input type="text" id="coordinates" name="latitude_longitude" readonly
                       class="w-full p-2 mt-2 border rounded-lg" placeholder="Координати з'являться тут"
                       value="{{ old('latitude_longitude', isset($location) ? $location->latitude . ', ' . $location->longitude : '') }}">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Зображення:</label>
                <input type="file" name="image" id="image" class="w-full p-2 border rounded-lg">
                @if(isset($location) && $location->image_path)
                    <img src="{{ asset('storage/' . $location->image_path) }}" class="mt-2 h-32 w-32 object-cover">
                @endif
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    {{ isset($location) ? 'Оновити' : 'Створити' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => console.error(error));

        const map = L.map('map').setView([48.3794, 31.1656], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);
        let marker;

        map.on('click', function (e) {
            const {lat, lng} = e.latlng;
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(map);
            document.getElementById('coordinates').value = `${lat}, ${lng}`;
        });
    </script>
</x-app-layout>

