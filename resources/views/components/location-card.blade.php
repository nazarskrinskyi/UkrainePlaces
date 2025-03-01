@props(['image', 'title', 'rating' => 0])

<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
  <img class="w-full h-48 object-cover" src="{{ $image }}" alt="{{ $title }}">
  <div class="p-4">
    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
    <div class="flex items-center mt-2  ">
      <x-star-rating :rating="$rating" />
      <span
        class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded-sm dark:bg-blue-200 dark:text-blue-800 ms-3">{{ $rating }}</span>

    </div>
  </div>
</div>