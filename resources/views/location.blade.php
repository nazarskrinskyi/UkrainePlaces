@php
    $formatter = new IntlDateFormatter(
        app()->getLocale(),
        IntlDateFormatter::FULL,
        IntlDateFormatter::NONE,
        'Europe/Kiev',
        IntlDateFormatter::GREGORIAN,
        'd MMMM yyyy',
    );
    $isMobile =
        request()->header('User-Agent') && preg_match('/Mobile|Android|iPhone/', request()->header('User-Agent'));
@endphp


<x-app-layout>
    @if (session('success'))
        <x-pop-up message="{{ session('success') }}" />
    @endif

    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $location->getTranslatedName(app()->getLocale()) }}</h1>

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
                        <p class="text-gray-800 dark:text-gray-200 text-center">{{ __('location.latitude') }}:
                            {{ $location->latitude }}</p>
                    </div>
                    <div class="w-1/2">
                        <p class="text-gray-800 dark:text-gray-200 text-center">{{ __('location.longitude') }}:
                            {{ $location->longitude }}</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md overflow-hidden ">
            <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">{{ __('location.description') }}
            </h2>
            <div
                class="ck-content text-gray-800 dark:text-gray-200 break-words border border-gray-400 dark:border-gray-600 p-4 rounded-lg">
                {!! $location->getTranslatedDescription(app()->getLocale()) !!}</div>
        </div>
        <div class="flex justify-between text-md text-gray-600 dark:text-gray-300">
            <span>{{ __('location.author') }} {{ $user_name }}</span>
            @if (Auth::user() && Auth::user()->id == $location->user_id)
                <div class="space-x-4">
                    <x-secondary-button class="hover:underline"><a
                            href="{{ UrlHelper::localizedRoute('location.edit.form', $location->id) }}">Редагувати</a></x-secondary-button>
                </div>
            @endif
        </div>

        <!-- Comments -->
        <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg shadow-md">
            @auth
                <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">{{ __('location.leave_review') }}
                </h2>
                <form method="POST" action="{{ UrlHelper::localizedRoute('review.create') }}"
                    class="space-y-4 mb-4 border border-gray-300 rounded-lg dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 p-2">
                    @csrf
                    <textarea name="comment" placeholder="{{ __('location.your_review') }}"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2"></textarea>

                    <!-- Контейнер для зірок -->
                    <div class="flex items-center justify-between">
                        <div x-data="{ rating: 0, hoverRating: -1 }" class="flex space-x-2">
                            <template x-for="i in 5">
                                <svg @click="rating = i" @mouseover ="hoverRating = i" @mouseleave="hoverRating = -1"
                                    :class="{
                                        'text-yellow-500': i <= (hoverRating >= 0 ? hoverRating :
                                            rating),
                                        'text-gray-300': i > (hoverRating >= 0 ? hoverRating : rating)
                                    }"
                                    class="w-6 h-6 cursor-pointer transition-all duration-300" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.946a1 1 0 00.95.69h4.134c.969 0 1.371 1.24.588 1.81l-3.347 2.43a1 1 0 00-.364 1.118l1.286 3.946c.3.92-.755 1.688-1.54 1.118l-3.347-2.43a1 1 0 00-1.176 0l-3.347 2.43c-.784.57-1.838-.198-1.54-1.118l1.286-3.946a1 1 0 00-.364-1.118L2.091 9.373c-.783-.57-.381-1.81.588-1.81h4.134a1 1 0 00.95-.69l1.286-3.946z">
                                    </path>
                                </svg>
                            </template>
                            <input type="number" class="hidden" name="rating" x-model="rating">
                            <input type="hidden" name="location_id" value="{{ $location->id }}">
                        </div>

                        <x-primary-button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition">{{ __('location.leave_review') }}</x-primary-button>
                    </div>
                </form>
            @endauth
            <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Відгуки</h2>
            <div class="space-y-4">
                @foreach ($location->reviews as $comment)
                    <div class="flex gap-10 p-2 bg-white dark:bg-gray-900 rounded-lg shadow-md">
                        <div class='flex flex-col gap-3'>
                            <x-star-rating :rating="$comment->rating" />
                            <span
                                class="text-xs text-gray-500 dark:text-gray-400">{{ $formatter->format(strtotime($comment->created_at)) }}</span>
                        </div>
                        <div class="grow flex flex-col gap-1">
                            <p class="text-gray-700 dark:text-gray-300 font-semibold">{{ $comment->user->name }}</p>
                            <p class="text-gray-700 dark:text-gray-300">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Location Footer -->
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

        @if ($isMobile)
            <a href="{{ UrlHelper::localizedRoute('location.navigate', ['id' => $location->id]) }}"
                class="mobile-map-button mobile-only">
                📍 Прокласти маршрут
            </a>
        @endif
</x-app-layout>
