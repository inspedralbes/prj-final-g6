<template>
    <div>
        <header>
            <nav>
                <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#">Explorar</a></li>
                    <li><a href="#">Perfil</a></li>
                </ul>
            </nav>
        </header>

        <!-- Map container -->
        <div id="map" style="height: 500px; width: 100%;"></div>
    </div>
</template>
  
<script>
export default {
    mounted() {
        // Ensure Leaflet is loaded before initializing the map
        if (process.client) {
            // Load Leaflet CSS dynamically
            const leafletCSS = document.createElement('link');
            leafletCSS.rel = 'stylesheet';
            leafletCSS.href = 'https://unpkg.com/leaflet/dist/leaflet.css';
            document.head.appendChild(leafletCSS);

            // Load Leaflet JS dynamically
            const leafletJS = document.createElement('script');
            leafletJS.src = 'https://unpkg.com/leaflet/dist/leaflet.js';
            leafletJS.onload = this.initMap;
            document.body.appendChild(leafletJS);
        }
    },
    methods: {
        initMap() {
            // Create a Leaflet map and set its initial view to Spain
            const map = L.map('map', {
                center: [40, -4],
                zoom: 6,
                minZoom: 6,
                maxZoom: 14,
            });

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }).addTo(map);

            // Set up possible locations with pop-up content
            const locations = [
        
                { latLng: [41.35567342431939, 2.0947632393357907], popupContent: 'MALALTS DE FESTA' },
               
                // Add more locations as needed
            ];

            // Add markers and pop-ups for each location
            locations.forEach((location) => {
                const marker = L.marker(location.latLng).addTo(map);
                marker.bindPopup(location.popupContent);
            });
        },
    },
};
</script>
  