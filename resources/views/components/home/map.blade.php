@props(['regions'])
<div class="ua-container">
  <svg xmlns:mapsvg="http://mapsvg.com" xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg"
    xmlns="http://www.w3.org/2000/svg" mapsvg:geoViewBox="22.138577 52.380834 40.220623 44.387017" width="612.47321"
    height="408.0199">
    @foreach($regions as $region)
    <path class="region" d="{{ $region->coordinates }}" title="{{ $region->code }}" data-name="{{ $region->name }}"
      id="{{ $region->id }}" />
  @endforeach
  </svg>
  <p class="font-bold mt-4 text-center text-lg text-gray-800 dark:text-gray-200" id="region-name"></p>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {

    const title = document.getElementById("region-name");
    document.querySelectorAll(".region").forEach((region) => {
      region.addEventListener("click", function () {
        let regionName = this.getAttribute("title");
        let encodedName = encodeURIComponent(regionName);
        window.location.href = `/region/${encodedName}`;
      });


      region.addEventListener("mouseover", function () {
        title.textContent = this.getAttribute("data-name");
        this.parentNode.appendChild(this);
      });
    });
  });

</script>

<style>
  svg {
    overflow: visible;
  }

  .ua-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
    min-height: 480px;
  }

  @media screen and (max-width: 768px) {
    .ua-container {
      scale: 0.6
    }
  }

  .region {
    fill: #ddd;
    stroke: #333;
    cursor: pointer;
    transition: all 0.3s;
  }

  .region-active {
    fill: #c2dbfd !important;
  }

  .region:hover {
    fill: #aaa;
    transform: translateY(-5px) translateX(5px);
  }
</style>