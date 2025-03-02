
<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 shadow-md rounded-lg">
        <h2 class="text-xl font-bold mb-4">{{ isset($city) ? 'Редагувати місто' : 'Створити місто' }}</h2>

        <form action="{{ isset($city) ? route('admin.city.update', $city) : route('admin.city.store') }}" method="POST">
            @csrf
            @if(isset($city))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Назва міста:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $city->name ?? '') }}" class="w-full p-2 border rounded-lg">
            </div>

            <div class="mb-4">
                <label for="code" class="block text-gray-700">Код міста:</label>
                <input type="text" name="code" id="code" value="{{ old('code', $city->code ?? '') }}" class="w-full p-2 border rounded-lg">
            </div>

            <div class="map-container">
                <h2>Інтерактивна карта</h2>
                <div id="map" class="h-64 w-full border rounded-lg"></div>
                <input type="text" id="map_coordinates" name="map_coordinates" readonly class="w-full p-2 mt-2 border rounded-lg" placeholder="Координати з'являться тут" value="{{ old('map_coordinates', $city->map_coordinates ?? '') }}">
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                    {{ isset($city) ? 'Оновити' : 'Створити' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        const map = L.map('map').setView([48.3794, 31.1656], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);
        let marker;

        map.on('click', function(e) {
            const { lat, lng } = e.latlng;
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(map);
            document.getElementById('map_coordinates').value = `${lat}, ${lng}`;
        });
    </script>
</x-app-layout>

