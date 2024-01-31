<template>
    <div class="container">

        <nav class="navbar">
            <ul>
                <li><a href="#">INICIO</a></li>
                <li><a href="#">EXPLORAR</a></li>
                <li><a href="#">PERFIL</a></li>
                <li id="Barcelona">BARCELONA</li>
            </ul>
        </nav>

        <div id="map" style="height: 720px; width: 100%;"></div>

        <div v-if="punto_de_interes_seleccionado" class="info-card">
            <div class="card">
                <div class="card-header">
                    <h3>{{ punto_de_interes_seleccionado.nombre_discoteca }}</h3>


                </div>
                <div class="card-closer" @click="cerrarPopUp">X</div>
                <div class="card-body">
                    <!-- <p>{{ punto_de_interes_seleccionado.description }}</p> -->
                    LOREM IPSUM DOLOR, SIT AMET CONSECTETUR ADIPISICING ELIT. VOLUPTAS IUSTO PERSPICIATIS ISTE SINT QUI
                    OBCAECATI NUMQUAM SAPIENTE? LAUDANTIUM, IMPEDIT LABORUM ODIO NISI DELENITI IN SAPE OBCAECATI NIHIL,
                    ALIQUID MAXIME IUSTO.

                    LOREM IPSUM DOLOR SIT AMET CONSECTETUR ADIPISICING ELIT. MOLESTIAE DELENITI, SEQUI DOLORE QUIA, NOBIS
                    ITAQUE CORRUPTI AMET TENETUR DESERUNT QUI QUAM, SIT IURE ISTE MODI DOLOREQUE. APERIAM QUASI DEBITIS
                    UNDE.
                </div>
            </div>
        </div>
        <footer>

        </footer>
    </div>
</template>

  
<script>
export default {
    head() {
        return {
            link:
                [
                    {
                        rel: 'preconnect',
                        href: 'https://fonts.googleapis.com',
                    },
                    {
                        rel: 'preconnect',
                        href: 'https://fonts.gstatic.com',
                        crossorigin: true,
                    },
                    {
                        rel: 'stylesheet',
                        href: 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&display=swap',
                    },
                ],
        };
    },
    data() {
        return {
            punto_de_interes_seleccionado: null,
            map: null,
            arr_puntos_de_interes: [],
            marker: null,
            data: null,
        };
    },
    mounted() {

        if (process.client) {

            const leafletCSS = document.createElement('link');
            leafletCSS.rel = 'stylesheet';
            leafletCSS.href = 'https://unpkg.com/leaflet/dist/leaflet.css';
            document.head.appendChild(leafletCSS);


            const leafletJS = document.createElement('script');
            leafletJS.src = 'https://unpkg.com/leaflet/dist/leaflet.js';
            leafletJS.onload = this.initMap;
            document.body.appendChild(leafletJS);
        }



    },
    methods: {
        fetchData(){
          
        },
        cerrarPopUp(){
            this.punto_de_interes_seleccionado = null;
        },
        initMap() {
            this.map = L.map('map', {
                center: [40, -4],
                zoom: 6,
                minZoom: 6,
                maxZoom: 17,
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }).addTo(this.map);


            const locations = [
                { latLng: [41.35567342431939, 2.0947632393357907], nombre_discoteca: 'MALALTS DE FESTA', descripcion: '', },
                { latLng: [41.397917303330644, 2.19113223925985], nombre_discoteca: 'RAZZMATAZZ' },
                { latLng: [41.393762946100026, 2.157926368172369], nombre_discoteca: 'TWENTIES BARCELONA' },
                { latLng: [41.37456718887626, 2.169596668171634], nombre_discoteca: 'SALA APOLO' },
                { latLng: [41.39603579270717, 2.188619054677886], nombre_discoteca: 'WOLF BARCELONA' },
                { latLng: [41.36033448432702, 2.109363168171127], nombre_discoteca: 'SALA SALAMANDRA' },
                { latLng: [41.39565454188381, 2.1522306970075755], nombre_discoteca: 'LA BIBLIO BARCELONA' },
            ];

            this.map.on('zoomend', () => {
                this.clearMarkers();
                this.crearLocalizacionesEnElMapa(locations);
            });


            this.crearLocalizacionesEnElMapa(locations);
        },

        crearLocalizacionesEnElMapa(locations) {
            const zoomLevel = this.map.getZoom();

            document.getElementById('Barcelona').addEventListener('click', () => {
                this.map.setView([41.35567342431939, 2.0947632393357907], 12);
            });


            if (zoomLevel >= 12) {
                locations.forEach((location) => {
                    const marker = L.marker(location.latLng).addTo(this.map);

                    marker.bindPopup((location.nombre_discoteca), { className: 'custom-popup' });


                    marker.on('click', () => {
                        this.punto_de_interes_seleccionado = location;
                    });

                    this.marker = marker;
                    this.arr_puntos_de_interes.push(marker);
                });
            }
        },
        clearMarkers() {
            this.arr_puntos_de_interes.forEach((marker) => {
                marker.remove();
            });
            this.arr_puntos_de_interes = [];
        },
    },
};
</script>
  

  
<script>

export default {
    head() {
        return {
            link:
                [
                    {
                        rel: 'preconnect',
                        href: 'https://fonts.googleapis.com',
                    },
                    {
                        rel: 'preconnect',
                        href: 'https://fonts.gstatic.com',
                        crossorigin: true,
                    },
                    {
                        rel: 'stylesheet',
                        href: 'https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Fjalla+One&display=swap',
                    },
                ],
        };
    },
    data() {
        return {
            punto_de_interes_seleccionado: null,
            map: null,
            arr_puntos_de_interes: [],
            marker: null,
            data: [],
        };
    },
    mounted() {

        if (process.client) {

            const leafletCSS = document.createElement('link');
            leafletCSS.rel = 'stylesheet';
            leafletCSS.href = 'https://unpkg.com/leaflet/dist/leaflet.css';
            document.head.appendChild(leafletCSS);


            const leafletJS = document.createElement('script');
            leafletJS.src = 'https://unpkg.com/leaflet/dist/leaflet.js';
            leafletJS.onload = this.initMap;
            document.body.appendChild(leafletJS);
        }



    },

    methods: {
        cerrarPopUp() {
            this.punto_de_interes_seleccionado = null;
        },
        initMap() {
            this.map = L.map('map', {
                center: [40, -4],
                zoom: 6,
                minZoom: 6,
                maxZoom: 17,
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
            }).addTo(this.map);


            const locations = [
                { latLng: [41.35567342431939, 2.0947632393357907], nombre_discoteca: 'MALALTS DE FESTA', descripcion: '', },
                { latLng: [41.397917303330644, 2.19113223925985], nombre_discoteca: 'RAZZMATAZZ' },
                { latLng: [41.393762946100026, 2.157926368172369], nombre_discoteca: 'TWENTIES BARCELONA' },
                { latLng: [41.37456718887626, 2.169596668171634], nombre_discoteca: 'SALA APOLO' },
                { latLng: [41.39603579270717, 2.188619054677886], nombre_discoteca: 'WOLF BARCELONA' },
                { latLng: [41.36033448432702, 2.109363168171127], nombre_discoteca: 'SALA SALAMANDRA' },
                { latLng: [41.39565454188381, 2.1522306970075755], nombre_discoteca: 'LA BIBLIO BARCELONA' },
            ];

            this.map.on('zoomend', () => {
                this.clearMarkers();
                this.crearLocalizacionesEnElMapa(locations);
                if (this.map.getZoom() >= 12) {
                    llevar_a_barcelona.remove();
                } else {
                    llevar_a_barcelona.addTo(this.map);
                }
            });

            var barcelonaIcon = L.icon({
                iconUrl: './mark.png',

                iconSize: [40, 40], // size of the icon
                iconAnchor: [22, 54], // point of the icon which will correspond to marker's location

                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
            });


            var llevar_a_barcelona = L.marker([41.39565454188381, 2.1522306970075755], { icon: barcelonaIcon }).addTo(this.map);
            llevar_a_barcelona.on('click', () => {
                this.map.setView([41.35567342431939, 2.0947632393357907], 12);
            });


            this.crearLocalizacionesEnElMapa(locations);
        },

        crearLocalizacionesEnElMapa(locations) {
            const zoomLevel = this.map.getZoom();


            if (zoomLevel >= 12) {
                locations.forEach((location) => {
                    const marker = L.marker(location.latLng, { icon: L.icon({ iconUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/images/marker-icon.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] }) }).addTo(this.map);


                    marker.bindPopup((location.nombre_discoteca));

                    marker.on('click', () => {
                        this.punto_de_interes_seleccionado = location;
                        marker.closePopup(); 

                    });

                    this.marker = marker;
                    this.arr_puntos_de_interes.push(marker);
                });
            }
        },
        clearMarkers() {
            this.arr_puntos_de_interes.forEach((marker) => {
                marker.remove();
            });
            this.arr_puntos_de_interes = [];
        },
    },
};
</script>
  
<!-- subir foto, crear disctoeca -->

<style>


.container {
    height: 100vh;
}

.card-closer {
    cursor: pointer;
    font-size: 30px;
    position: absolute;
    top: 8px;
    right: 12px;

    color: #fff;


}

footer {
    width: 100%;
    height: 100px;
    background-color: #1c1c1c;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    margin-bottom: 0;

}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Fjalla One', sans-serif;

}

.navbar {
    font-size: 30px;
    width: 100%;
    height: 150px;
    background-color: #1c1c1c;
    font-size: 30px;
}

.navbar ul {
    display: flex;
    justify-content: space-around;
    align-items: center;
    list-style: none;
    height: 100%;
}

.navbar ul li {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar ul li:hover,
.navbar ul li a:hover {
    color: #ffffff;
}

.navbar ul li a {
    text-decoration: none;
    color: #dfdfdf;
    font-weight: 600;
}


#Barcelona {
    color: #dfdfdf;
    font-weight: 600;
    cursor: pointer;
}

#map {
    height: 100%;
    width: 100%;
}

.info-card {
    position: absolute;
    top: 155px;
    right: 30px;
    z-index: 1000;
    max-width: 450px;
    background-color: #ffffff;
    border: 2px solid #1c1c1c;
    border-radius: 10px;
    color: #1c1c1c;
    box-shadow: 0 2px 5px rgb(0, 0, 0);

}


.card-header>h3 {
    margin: 0;
    font-size: 25px;
    font-weight: 600;
    color: #fff;
    text-align: center;
}

.card-header {
    background-color: #007BFF;
    border-radius: 8px;
    color: #fff;
    padding: 10px;

}

.card-body {
    text-align: justify;
    padding: 20px;
    line-height: 1.1;

    font-weight: bold;
}
</style>