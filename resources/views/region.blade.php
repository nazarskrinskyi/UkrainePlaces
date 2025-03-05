<x-app-layout>

  <div class="flex flex-col gap-6 py-12 container mx-auto">
    <x-slot name="footer">
      <x-footer />
    </x-slot>
    <!-- Description about region -->

    <!-- Map -->
    <x-home.map :regions="$regions" :selectedRegion="$region" />

    <!-- Filtering buttons -->
    <div><x-region.dropdown-filtering-button /></div>

    <!-- List of locations -->
    <div class="flex gap-6 justify-between">
      <div class="w-full">
        <div class="flex flex-wrap gap-6">
          @if (count($locations) == 0)
        <div
        class='w-full flex items-center justify-center h-48 text-center text-xl font-semibold text-gray-800 dark:text-gray-200 '>
        Локацій в області відсутні
        </div>
      @else
      @foreach ($locations as $location)
      <x-location-card :image="asset('uploads/' . $location->image_path)" :title="$location->name"
      :rating="(intval($location->avg_rating) == $location->avg_rating)
    ? intval($location->avg_rating)
    : number_format($location->avg_rating, 1)" />
    @endforeach
    @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>