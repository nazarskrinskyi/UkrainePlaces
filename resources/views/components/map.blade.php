@props(['regions', 'selectedRegion' => null])
<div class="ua-container">
    <svg xmlns:mapsvg="http://mapsvg.com" xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg"
        xmlns="http://www.w3.org/2000/svg" mapsvg:geoViewBox="22.138577 52.380834 40.220623 44.387017" width="612.47321"
        height="408.0199">
        @foreach ($regions as $region)
            <path class="region {{ $selectedRegion && $region->code == $selectedRegion->code ? 'region-active' : '' }}"
                d="{{ $region->coordinates }}" title="{{ $region->code }}" data-name="{{ $region->getTranslatedName(app()->getLocale()) }}"
                id="{{ $region->code }}" />
        @endforeach
    </svg>
    <p class="font-bold mt-4 text-center text-lg text-gray-800 dark:text-gray-200" id="region-name"></p>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const title = document.getElementById("region-name");
        document.querySelectorAll(".region").forEach((region) => {
            region.addEventListener("click", function() {
                let regionName = this.getAttribute("title");
                let encodedName = encodeURIComponent(regionName);
                window.location.href = `/region/${encodedName}`;
            });


            region.addEventListener("mouseover", function() {
                title.textContent = this.getAttribute("data-name");
                this.parentNode.appendChild(this);
            });

            region.addEventListener("mouseout", function() {
                title.textContent = "";
                console.log('test');

            });
        });
    });
</script>
