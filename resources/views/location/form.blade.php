<x-app-layout>
    <div class="max-w-5xl mx-auto bg-white p-8 shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6">{{ isset($location) ? 'Редагувати локацію' : 'Створити локацію' }}</h2>


        <form action="{{ isset($location) ? route('location.update', $location) : route('location.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($location))
                @method('PUT')
            @endif

            <div>
                <label for="name" class="block text-gray-700">Назва локації:</label>
                <input type="text" name="name" id="name"
                       value="{{ old('name', $location->name ?? '') }}"
                       class="w-full p-3 border rounded-lg">
            </div>

            <div>
                <label for="editor" class="block text-gray-700">Опис:</label>
                <input type="hidden" name="description" id="description"
                       value="{{ old('description', $location->description ?? '') }}">
                <div id="editor" class="border rounded-lg p-2 min-h-[200px]">
                    {!! old('description', $location->description ?? '') !!}
                </div>
            </div>

            <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.css" crossorigin>
            <script src="https://cdn.ckeditor.com/ckeditor5/44.2.1/ckeditor5.umd.js" crossorigin></script>

            <script>
                let editorInstance;

                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        editorInstance = editor;
                        document.querySelector('form').addEventListener('submit', (event) => {
                            // Ensure editor content is updated in the hidden input before submitting
                            document.querySelector('#description').value = editorInstance.getData();
                        });
                    })
                    .catch(error => console.error(error));
            </script>

            <div>
                <label for="city_id" class="block text-gray-700">Місто:</label>
                <select name="city_id" id="city_id" class="w-full p-3 border rounded-lg">
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ isset($location) && $location->city_id == $city->id ? 'selected' : '' }}>
                            {{ $city->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <div>
                <h3 class="block text-gray-700 mb-2">Інтерактивна карта</h3>
                <div id="map" class="h-72 w-full border rounded-lg" style="width: 100%"></div>

                <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-gray-700">Широта (Latitude):</label>
                        <input type="text" id="latitude" name="latitude"
                               value="{{ old('latitude', $location->latitude ?? '') }}"
                               readonly
                               class="w-full p-3 border rounded-lg">
                    </div>
                    <div>
                        <label for="longitude" class="block text-gray-700">Довгота (Longitude):</label>
                        <input type="text" id="longitude" name="longitude"
                               value="{{ old('longitude', $location->longitude ?? '') }}"
                               readonly
                               class="w-full p-3 border rounded-lg">
                    </div>
                </div>
            </div>

            <div>
                <label for="image" class="block text-gray-700">Зображення:</label>
                <input type="file" name="image_path" id="image" class="w-full p-3 border rounded-lg">
                @if(isset($location) && $location->image_path)
                    <img src="{{ asset('storage/' . $location->image_path) }}" class="mt-3 h-32 w-32 object-cover">
                @endif
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg">
                {{ isset($location) ? 'Оновити' : 'Створити' }}
            </button>
        </form>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        const map = L.map('map').setView([48.3794, 31.1656], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;
        @if(isset($location) && !empty($location->latitude))
        const [lat, lng] = ["{{ $location->latitude }}", "{{ $location->longitude }}"];
        marker = L.marker([lat, lng]).addTo(map);
        map.setView([lat, lng], 12);
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        @endif

        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
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
