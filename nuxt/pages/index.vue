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

        <div id="map" ref="map" style="height: 100%; width: 100%;"></div>

        <div v-if="punto_de_interes_seleccionado && pin_seleccionado" class="info-card">
            <div class="card">
                <div class="card-header">
                    <h3>{{ pin_seleccionado.titulo }}</h3>
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

export default {
    head() {
        return {
            link: [
                {
                    rel: 'stylesheet',
                    href: 'https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css',
                },
                {
                    rel: 'stylesheet',
                    href: 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
                },
                {
                    rel: 'stylesheet',
                    href: 'https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css'
                }

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
            puntos_de_interes: [
                { coordenadas: [2.0947632393357907, 41.35567342431939], titulo: 'MALALTS DE FESTA', imagenUrl: '', descripcion: '', },
                { coordenadas: [2.19113223925985, 41.397917303330644], titulo: 'RAZZMATAZZ' },
                { coordenadas: [2.157926368172369, 41.393762946100026], titulo: 'TWENTIES BARCELONA' },
                { coordenadas: [2.169596668171634, 41.37456718887626], titulo: 'SALA APOLO' },
                { coordenadas: [2.188619054677886, 41.39603579270717], titulo: 'WOLF BARCELONA' },
                { coordenadas: [2.109363168171127, 41.36033448432702], titulo: 'SALA SALAMANDRA' },
                { coordenadas: [2.1522306970075755, 41.39565454188381], titulo: 'LA BIBLIO BARCELONA' },
            ],
            icono_llevar_a_barcelona: null,
        };
    },
    mounted() {

        this.initMapaDatosMapBox();

        this.map.on('load', () => {

            this.crear_mostrar_pines_discos();

            this.crear_mostrar_pin_barcelona();

            this.establecer_visibilidad_segun_zoom_pines();

            this.añadir_popup_info_de_las_discos();

        });


    },

    methods: {
        initMapaDatosMapBox() {
            mapboxgl.accessToken = 'pk.eyJ1IjoiYTIyam9zbGFyZmVyIiwiYSI6ImNsczIwdDY5YTBldncyc21rbmI4cnVjY3oifQ.mWjSoIuuwJmMG0EFCU_gEA';

            this.map = new mapboxgl.Map({
                container: this.$refs.map,
                style: 'mapbox://styles/a22joslarfer/cls1zcyoh013v01qy03s63ok6',
                center: [2.0947632393357907, 39.35567342431939],
                zoom: 5,
            });
      
        },
        crear_mostrar_pines_discos() {
            if (this.map.getLayer('points')) {
                this.map.removeLayer('points');
            }

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
                            'titulo': punto.titulo,
                            'horario': '',
                            'imagen': '',
                            'descripcion': '',
                            'telefono': '',
                        }
                    }))
                }
            });



            this.map.addLayer({
                'id': 'points',
                'type': 'circle',
                'source': 'points',
                'layout': {
                    'visibility': 'visible'
                },
                'paint': {
                    'circle-radius': 10,
                    'circle-color': '#dfdfdf',
                },
                'minzoom': 10,
                'maxzoom': 15,
            });


        },
        crear_mostrar_pin_barcelona() {

            this.map.addLayer({
                'id': 'barcelona-pin',
                'type': 'circle',
                'source': {
                    'type': 'geojson',
                    'data': {
                        'type': 'FeatureCollection',
                        'features': [{
                            'type': 'Feature',
                            'geometry': {
                                'type': 'Point',
                                'coordinates': [2.0947632393357907, 41.35567342431939],
                            },
                            'properties': {
                                'id': 'barcelona-pin',
                            }
                        }]
                    }
                },
                'layout': {
                    'visibility': 'visible'
                },
                'paint': {
                    'circle-radius': 15,
                    'circle-color': '#ff0000',
                },
            });

            

        },
        establecer_visibilidad_segun_zoom_pines() {

            const establecer_visibilidad_pines = () => {
                const currentZoom = this.map.getZoom();
                if (currentZoom >= 12) {
                    this.map.setLayoutProperty('points', 'visibility', 'visible');
                    this.map.setLayoutProperty('barcelona-pin', 'visibility', 'none');
                } else {
                    this.map.setLayoutProperty('points', 'visibility', 'none');
                    this.map.setLayoutProperty('barcelona-pin', 'visibility', 'visible');
                }
            };

            establecer_visibilidad_pines();


            this.map.on('zoom', () => {
                establecer_visibilidad_pines();
            });


            this.map.on('click', 'barcelona-pin', () => {

                this.map.flyTo({
                    center: [2.0947632393357907, 41.35567342431939],
                    zoom: 12,
                });

                this.map.setLayoutProperty('barcelona-pin', 'visibility', 'none');
            });
        },
        añadir_popup_info_de_las_discos() {
            this.map.on('click', 'points', (e) => {
                // Get the id of the clicked point
                this.cerrarPopUp();
                const id = e.features[0].properties.id;
                console.log('Clicked point id:', id);
                console.log('Selected point:', this.puntos_de_interes[id]);

                this.punto_de_interes_seleccionado = true;
                this.pin_seleccionado = this.puntos_de_interes[id];
            });

        },
        cerrarPopUp() {
            this.punto_de_interes_seleccionado = null;
            this.pin_seleccionado = null;
        },
        clearMarkers() {
            this.arr_puntos_de_interes.forEach(marker => marker.remove());
            this.arr_puntos_de_interes = [];
        },

    },
};

</script>
  


<style>
@import url('https://fonts.googleapis.com/css2?family=Antonio:wght@700&display=swap');

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
    overflow-y: hidden;
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
    color: var(----blanco);
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
    color: var(--base);

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