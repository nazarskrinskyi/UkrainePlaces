<x-app-layout>
    <div class="flex flex-col gap-6 py-12 container mx-auto">
        <x-slot name="footer">
            <x-footer />
        </x-slot>

        <!-- Heading -->
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Про сайт WonderUA</h1>

        <!-- Description -->
        <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <p class="text-gray-800 dark:text-gray-200">
                <strong>WonderUA</strong> — це платформа, де користувачі можуть досліджувати цікаві, відомі та
                маловідомі міста України,
                дізнаватися про їхню історію, культуру та особливості. Кожен може не лише ознайомитися з містами та
                регіонами,
                але й додавати власні цікаві місця, інтерактивно вносячи інформацію.
            </p>
        </div>

        <!-- Features -->
        <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Функціонал сайту</h2>
            <ul class="list-disc list-inside text-gray-800 dark:text-gray-200 space-y-2">
                <li><strong>Дослідження міст та регіонів:</strong> Перегляд карт та інформаційних сторінок про міста й
                    села України.</li>
                <li><strong>Додавання нових місць:</strong> Зареєстровані користувачі можуть додавати нові локації,
                    описувати їх, додавати фото та координати.</li>
                <li><strong>Підтримка українських виробників:</strong> Заохочуємо додавати локації, пов'язані з
                    місцевими підприємствами.</li>
                <li><strong>Інтерактивна карта:</strong> Відображення місць на карті для зручності пошуку.</li>
                <li><strong>Система рейтингів та відгуків:</strong> Користувачі можуть оцінювати місця та залишати
                    відгуки.</li>
            </ul>
        </div>

        <!-- Image -->
        <div class="flex justify-center">
            <img src="{{ asset('assets/img/ua-banner.jpg') }}" alt="WonderUA Banner" class="rounded-lg shadow-md w-1/2">
        </div>
    </div>
</x-app-layout>
