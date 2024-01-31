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
                maxZoom: 17,
            });

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }).addTo(map);

            // Set up possible locations with pop-up content
            const locations = [
        
                { latLng: [41.35567342431939, 2.0947632393357907], popupContent: 'MALALTS DE FESTA' },
                { latLng: [41.397917303330644, 2.19113223925985],  popupContent: 'RAZZMATAZZ'},
                { latLng: [41.393762946100026, 2.157926368172369], popupContent: 'TWENTIES BARCELONA'},
                { latLng: [41.37456718887626, 2.169596668171634], popupContent: 'SALA APOLO'},
                { latLng: [41.39603579270717, 2.188619054677886], popupContent: 'WOLF BARCELONA'},
                { latLng: [41.36033448432702, 2.109363168171127], popupContent: 'SALA SALAMANDRA'},
                { latLng: [41.39565454188381, 2.1522306970075755], popupContent: 'LA BIBLIO BARCELONA'},


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
  