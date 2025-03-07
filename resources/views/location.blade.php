<x-app-layout>
    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ $location->name }}</h1>

        <!-- Image and description -->
        <div class="flex gap-6">
            <div class="w-1/2">
                <img src="{{ asset('uploads/' . $location->image_path) }}" alt="Location Image"
                    class="w-full rounded-lg shadow-md">
            </div>
            <div class="w-1/2 bg-gray-100 dark:bg-gray-800 p-4 rounded-lg shadow-md">
                <p class="text-gray-800 dark:text-gray-200">{{ $location->description }}</p>
            </div>
        </div>

        <!-- Gallery -->
        <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">GALLERY</h2>
            <div class="grid grid-cols-3 gap-4">
                {{-- @foreach ($location->gallery as $image)
        <img src="{{ asset('uploads/' . $image->path) }}" alt="Gallery Image" class="w-full rounded-lg shadow-md">
        @endforeach --}}
            </div>
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
            <div class="space-x-4">
                <x-secondary-button class="hover:underline">Редагувати</x-secondary-button>
            </div>
        </div>
    </div>
</x-app-layout>
