<form class="flex-grow max-w-sm mx-auto">
    <select id="default"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        onchange="handleSelectRegion(event)">
        <option selected>Перейти до регіону</option>
        @foreach ($regions as $region)
            <option value="{{ $region->code }}">
                {{ $region->name }}
            </option>
        @endforeach
    </select>
</form>

<script>
    function handleSelectRegion(event) {
        const region = event.target.value;
        console.log('Selected value:', region);
        if (region) {
            let encodedName = encodeURIComponent(region);
            window.location.href = `/region/${encodedName}`;
        }
    }
</script>
