<x-app-layout>
    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Контакти</h1>

        <!-- Contact Information -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <p class="text-gray-800 dark:text-gray-200">
                Якщо у вас є запитання, пропозиції або ви хочете долучитися до розвитку платформи WonderUA, зв'яжіться з
                нами.
            </p>
        </div>

        <!-- Team Members -->
        <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Наша команда</h2>
            <ul class="list-disc list-inside text-gray-800 dark:text-gray-200 space-y-2">
                <li><strong>Мельник Владислав</strong> – vlad.melnyk28@gmail.com</li>
                <li><strong>Скринський Назар</strong> – nazarskrinskyi@gmail.com</li>
            </ul>
        </div>

        <!-- Contact Form -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Напишіть нам</h2>
            <form action="{{ route('contact-us.upload') }}" method="POST" class="space-y-4">
                @csrf
                <x-text-input type="text" name="username" placeholder="Ваше ім'я" class="w-full " />
                <x-text-input type="email" name="email" placeholder="Ваш Email" class="w-full" />
                <textarea name="content" placeholder="Ваше повідомлення"
                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                <x-primary-button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md">Відправити</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
