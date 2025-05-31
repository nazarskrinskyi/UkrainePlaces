@php
    $locales = [
        'uk' => __('language.uk'),
        'en' => __('language.en'),
    ];
@endphp

<div
    class="flex items-center p-1 bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-white font-semibold rounded-lg gap-1 overflow-hidden">
    @foreach ($locales as $locale => $name)
        <a href="{{ $locale == 'en' ? request()->fullUrlWithQuery(['lang' => 'en']) : url()->current() }}"
            class="flex-1 text-center px-2 py-1 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600
            {{ $locale === app()->getLocale() ? 'bg-gray-300 dark:bg-gray-600' : '' }}">{{ $name }}</a>
    @endforeach
</div>
