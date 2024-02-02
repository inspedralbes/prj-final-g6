<template>
    <div class="container">
        <nav class="navbar">
            <ul>
                <li><a href="#">INICIO</a></li>
                <li><a href="#">EXPLORAR</a></li>
                <li><a href="#">PERFIL</a></li>
                <li id="Barcelona">BARCELONA</li>
                <div id="map-search" ref="mapSearch"></div>

            </ul>
        </nav>

      

        <div id="map" ref="map" style="height: 100%; width: 100%;"></div>

        <div v-if="punto_de_interes_seleccionado && pin_seleccionado" class="info-card">
            <div class="card">
                <div class="card-header">
                    <h3>{{ pin_seleccionado.nombre_discoteca }}</h3>
                    <div class="card-closer" @click="cerrarPopUp">X</div>

                </div>
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
import mapboxgl from 'mapbox-gl';
import MapboxGeocoder from '@mapbox/mapbox-gl-geocoder';
import 'mapbox-gl/dist/mapbox-gl.css';


export default {
    head() {

        return {
            link: [
                {
                    rel: 'stylesheet',
                    href: 'https://api.mapbox.com/mapbox-gl-js/v2.8.1/mapbox-gl.css',
                },
                {
                    rel: 'stylesheet',
                    href: 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
                },
                {
                    rel: 'stylesheet',
                    href: 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css',
             

                },

            ],
        };
    },

    data() {
        return {
            customData: {
                'features': [],
            },

            searchQuery: '',
            pin_seleccionado: null,
            punto_de_interes_seleccionado: null,
            map: null,
            arr_puntos_de_interes: [],
            marker: null,
            data: [],
            puntos_de_interes: [
                { coordenadas: [2.0947632393357907, 41.35567342431939], nombre_discoteca: 'MALALTS DE FESTA' },
                { coordenadas: [2.19113223925985, 41.397917303330644], nombre_discoteca: 'RAZZMATAZZ' },
                { coordenadas: [2.157926368172369, 41.393762946100026], nombre_discoteca: 'TWENTIES BARCELONA' },
                { coordenadas: [2.169596668171634, 41.37456718887626], nombre_discoteca: 'SALA APOLO' },
                { coordenadas: [2.188619054677886, 41.39603579270717], nombre_discoteca: 'WOLF BARCELONA' },
                { coordenadas: [2.109363168171127, 41.36033448432702], nombre_discoteca: 'SALA SALAMANDRA' },
                { coordenadas: [2.1522306970075755, 41.39565454188381], nombre_discoteca: 'LA BIBLIO BARCELONA' },
            ],
            icono_llevar_a_barcelona: null,
        };
    },
    mounted() {
        mapboxgl.accessToken = 'pk.eyJ1IjoiYTIyam9zbGFyZmVyIiwiYSI6ImNsczIwdDY5YTBldncyc21rbmI4cnVjY3oifQ.mWjSoIuuwJmMG0EFCU_gEA';

        this.map = new mapboxgl.Map({
            container: this.$refs.map,
            style: 'mapbox://styles/a22joslarfer/cls1zcyoh013v01qy03s63ok6',
            center: [2.0947632393357907, 39.35567342431939],
            zoom: 5,
        });
        const geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        localGeocoder: this.forwardGeocoder,
        zoom: 14,
        placeholder: 'Ingrese un lugar a buscar',
        mapboxgl: mapboxgl
    });
    this.map.addControl(geocoder, 'top-right'); 

     
        this.map.on('load', () => {
            // Add a source for the points of interest
            this.map.addSource('points', {
                'type': 'geojson',
                'data': {
                    'type': 'FeatureCollection',
                    'features': this.puntos_de_interes.map((punto, index) => ({
                        'type': 'Feature',
                        'geometry': {
                            'type': 'Point',
                            'coordinates': punto.coordenadas,
                        },
                        'properties': {
                            'id': index,
                            'nombre_discoteca': punto.nombre_discoteca,
                        }
                    }))
                }
            });

            this.map.addLayer({
                'id': 'points',
                'type': 'circle',
                'source': 'points',
                'paint': {
                    'circle-radius': 10,
                    'circle-color': '#dfdfdf',
                }
            });

            this.map.on('click', 'points', (e) => {
                // Get the id of the clicked point
                const id = e.features[0].properties.id;
                console.log('Clicked point id:', id);
                console.log('Selected point:', this.puntos_de_interes[id]);

                this.punto_de_interes_seleccionado = true;
                this.pin_seleccionado = this.puntos_de_interes[id];
            });
        });
    },

    methods: {

        cerrarPopUp() {
            this.punto_de_interes_seleccionado = null;
            this.selectedItem = null;

        },

        clearMarkers() {
            this.arr_puntos_de_interes.forEach(marker => marker.remove());
            this.arr_puntos_de_interes = [];
        },
      
        forwardGeocoder(query) {
            var matchingFeatures = [];
            for (var i = 0; i < this.customData.features.length; i++) {
                var feature = this.customData.features[i];
                if (
                    feature.properties.title
                        .toLowerCase()
                        .search(query.toLowerCase()) !== -1
                ) {
                    feature['place_name'] = '🌲 ' + feature.properties.title;
                    feature['center'] = feature.geometry.coordinates;
                    feature['place_type'] = ['park'];
                    matchingFeatures.push(feature);
                }
            }
            return matchingFeatures;
        },
    },
};
</script>

  
<!-- subir foto, crear disctoeca -->

<style>
@import url('https://fonts.googleapis.com/css2?family=Antonio:wght@700&display=swap');

/* Estilo para el contenedor del mapa (asumiendo que tienes otros estilos) */




.mapboxgl-ctrl-geocoder input[type="text"] {
    /* Add your custom styles here */
    width: 100%; /* Set the width as needed */
    padding: 10px; /* Adjust padding */
    font-size: 16px; /* Adjust font size */
    /* Add any other styles you want to customize */
}

/* Target the suggestion list (dropdown) */
.mapboxgl-ctrl-geocoder .suggestions {
    /* Add your custom styles for the suggestion list here */
    background-color: #fff; /* Example background color */
    border: 1px solid #ddd; /* Example border */
    /* Add any other styles you want to customize */
}

/* Target individual suggestions in the list */
.mapboxgl-ctrl-geocoder .suggestion-item {
    /* Add your custom styles for individual suggestions here */
    padding: 8px;
    cursor: pointer;
    /* Add any other styles you want to customize */
}

/* Style for the active (highlighted) suggestion */
.mapboxgl-ctrl-geocoder .suggestion-item.active {
    background-color: #f0f0f0; /* Example background color for active suggestion */
    /* Add any other styles you want to customize */
}

.material-symbols-outlined {
    font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
}

:root {
    /* ESQUEMA DE COLORES 1 */
    --base: hsl(0, 5%, 16%);
    --verde: hsl(155, 81%, 46%);
    --rosa: hsl(303, 97%, 85%);
    --carne: hsl(14, 45%, 89%);
    --azul: hsl(226, 64%, 58%);
    --blanco: hsl(0, 0%, 100%);
    /* ESQUEMA DE COLORES 2 */
    --base2: hsl(354, 9%, 5%);
    --verde2: hsl(124, 9%, 32%);
    --naranja: hsl(32, 85%, 76%);
    --carne2: hsl(32, 70%, 89%);
    --rojo: hsl(0, 84%, 15%);
    --azul2: hsl(213, 15%, 38%);
}

.container {
    height: 100vh;
}

footer {
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 50px;
    background-color: var(--base);

}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Antonio', sans-serif;
    overflow: hidden;
}

/* ESTILOS PARA LA BARRA DE NAVEGACION */

.navbar {
    font-size: 3vw;
    width: 100%;
    height: 150px;
    background-color: var(--base);
    font-size: 30px;
}

.navbar ul {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    list-style: none;
    height: 100%;
    color: var(--blanco);

}

.navbar ul li {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 60px;
}

.navbar ul li:hover,
.navbar ul li a:hover {
    color: var(--carne2);
}

.navbar ul li a {
    text-decoration: none;
    color: var(--blanco);
}


/* ESTILOS PARA LOS PANELES DE INFORMACION */
.info-card {
    position: absolute;
    top: 155px;
    right: 30px;
    z-index: 1000;
    max-width: 450px;
    background-color: var(--base);
    border-radius: 10px;
    color: var(--verde2);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.87);
    animation: fade-in 0.5s ease-in-out;
}

@keyframes fade-in {
    0% {
        opacity: 0.33;
        transform: translateY(40px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-closer {
    cursor: pointer;
    font-size: 2vw;
    color: var(--base);
    transition: color 0.2s ease-in-out;
}

.card-closer:hover {
    color: #ffffff;
}

.card-header {
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    background-color: var(--verde2);
    border-radius: 5px 5px 0 0;
    padding: 10px;
    font-size: 2vw;
    color: var(--verde);
    /* o el color que desees */
}




.card-body {
    text-align: justify;
    padding: 20px;
    line-height: 1.1;
    font-size: 1.2vw;

}

/* ESTILOS PARA MOBIL */

/* Media queries for responsiveness */
@media only screen and (max-width: 768px) {

    .navbar {
        font-size: 20px;
        height: 100px;
    }

    .navbar ul li {
        font-size: 30px;
    }

    .info-card {
        top: 105px;
        right: 10px;
        max-width: 350px;
    }

    .card-header>h3 {
        font-size: 30px;
    }

    .card-body {
        font-size: 20px;
    }

}
</style> 