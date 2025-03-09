@props(['message'])


<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 200);
setTimeout(() => show = false, 5000)" x-show="show"
    x-transition:enter="transition ease-out duration-500 transform opacity-0 scale-95 translate-y-[-10px]"
    x-transition:enter-start="display-none opacity-0 scale-95 translate-y-[-10px]"
    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
    x-transition:leave="transition ease-in duration-500 transform opacity-100 scale-100 translate-y-0"
    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
    x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
    class="fixed top-5 left-1/2 -translate-x-1/2 z-50 bg-green-500 text-white px-4 py-2 rounded shadow-md">
    {{ $message }}
</div>
