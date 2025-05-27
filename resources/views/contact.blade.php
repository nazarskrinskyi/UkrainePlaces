<x-app-layout>
    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ __('contact.title') }}</h1>

        <!-- Contact Information -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <p class="text-gray-800 dark:text-gray-200">
                {{ __('contact.description') }}
            </p>
        </div>

        <!-- Team Members -->
        <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">{{ __('contact.team_title') }}</h2>
            <ul class="list-disc list-inside text-gray-800 dark:text-gray-200 space-y-2">
                <li><strong>Мельник Владислав</strong> – vlad.melnyk28@gmail.com</li>
                <li><strong>Скринський Назар</strong> – nazarskrinskyi@gmail.com</li>
            </ul>
        </div>

        <!-- Contact Form -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">{{ __('contact.form_title') }}</h2>
            <form action="{{ UrlHelper::localizedRoute('contact-us.upload') }}" method="POST" class="space-y-4">
                @csrf
                <x-text-input type="text" name="username" :placeholder="__('contact.placeholder_name')" class="w-full" />
                <x-text-input type="email" name="email" :placeholder="__('contact.placeholder_email')" class="w-full" />
                <textarea name="content" :placeholder="__('contact.placeholder_message')"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                <x-primary-button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md">{{ __('contact.send_button') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
