<template>
  <div class="container">
    <nav class="navbar">
      <ul>
        <li></li>
        <li><nuxt-link to="/">INICIO</nuxt-link></li>
        <li><nuxt-link to="/explorar">EXPLORAR</nuxt-link></li>
        <li><nuxt-link to="/perfil">PERFIL</nuxt-link></li>
      </ul>
    </nav>
    <div id="buscador"></div>

    <div id="map" ref="map" style="height: 100%; width: 100%"></div>

    <div
      v-if="punto_de_interes_seleccionado && pin_seleccionado"
      class="info-card"
    >
      <div class="card">
        <div class="card-header">
          <h3>{{ pin_seleccionado.titulo }}</h3>
          <div class="card-closer" @click="cerrarPopUp">X</div>
        </div>
        <div class="card-body">
          <!-- <img :src="pin_seleccionado.imgUrl" alt="imagen de la discoteca" style="width: 100%; height: 200px; object-fit: cover;"> -->

          <p>Sobre el local: {{ pin_seleccionado.descripcion }}</p>

          <p>Horario: {{ pin_seleccionado.horario }}</p>

          <p>Telefono: {{ pin_seleccionado.telefono }}</p>

          <p>Edad minima: {{ pin_seleccionado.minEdad }}</p>
        </div>
      </div>
    </div>
    <footer></footer>
  </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import MapboxGeocoder from "@mapbox/mapbox-gl-geocoder";

export default {
  head() {
    return {
      link: [
        {
          rel: "stylesheet",
          href: "https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css",
        },
        {
          rel: "stylesheet",
          href: "https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css",
        },
        {
          rel: "stylesheet",
          href: "https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js",
        },
      ],
    };
  },
  data() {
    return {
      punto_de_interes_seleccionado: false,
      map: null,
      arr_puntos_de_interes: [],
      marker: null,
      data: [],
      icono_llevar_a_barcelona: null,
    };
  },
  mounted() {
    this.programarNotificacion();
    this.initMapaDatosMapBox();
    this.fetchData();

    this.map.on("load", () => {
      this.crear_mostrar_pines_discos();
      this.crear_mostrar_pin_barcelona();
      this.establecer_visibilidad_segun_zoom_pines();
      this.añadir_popup_info_de_las_discos();
    });

    //Localizacion y notificaicones
    Notification.requestPermission().then((permission) => {
      if (permission === "granted") {
        console.log("Permisos aceptados");
      }
    });

    if ("geolocation" in navigator) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const { latitude, longitude } = position.coords;
          console.log("Ubicación del usuario:", latitude, longitude);
        },
        (error) => {
          console.error("Error al obtener la ubicación:", error.message);
        }
      );
    } else {
      console.error("La geolocalización no es compatible en este navegador.");
    }
  },

  methods: {
    async fetchData() {
      const response = await fetch("http://localhost:8000/api/discotecas");

      const data = await response.json();

      this.data = data.map((discoteca) => {
        return {
          id: discoteca.id,
          titulo: discoteca.nombre_local,
          coordenadas: JSON.parse(discoteca.coordenadas),
          imgUrl: discoteca.imgUrl,
          descripcion: discoteca.descripcion,
          telefono: discoteca.telefono,
          horario: discoteca.horario,
          minEdad: discoteca.minEdad,
        };
      });
    },
    programarNotificacion() {
    const now = new Date();
    const horaEspecifica = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 12, 40, 0);
    const tiempoRestante = horaEspecifica - now;
    
    if (tiempoRestante > 0) {
      setTimeout(() => {
        this.enviarNotificacion();
      }, tiempoRestante);
    }
  },

  enviarNotificacion() {
    const opcionesNotificacion = {
      body: 'Es hora de publicar tu foto!',
    };

    new Notification('¡HORA DE BEREAL!', opcionesNotificacion).addEventListener;
  },
    initMapaDatosMapBox() {
      mapboxgl.accessToken =
        "pk.eyJ1IjoiYTIyam9zbGFyZmVyIiwiYSI6ImNsczIwdDY5YTBldncyc21rbmI4cnVjY3oifQ.mWjSoIuuwJmMG0EFCU_gEA";

      this.map = new mapboxgl.Map({
        container: this.$refs.map,
        style: "mapbox://styles/a22joslarfer/cls1zcyoh013v01qy03s63ok6",
        center: [2.0947632393357907, 39.35567342431939],
        zoom: 5,
      });
      var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl,
      });
      this.map.addControl(geocoder);
      this.$nextTick(() => {
        var geocoderElement = document.querySelector(".mapboxgl-ctrl-geocoder");
        var searchBar = document.getElementById("buscador");
        searchBar.appendChild(geocoderElement);
      });
    },
    crear_mostrar_pines_discos() {
      if (this.map.getLayer("points")) {
        this.map.removeLayer("points");
      }

      const features = this.data.map((punto, index) => {
        const coordinates = [punto.coordenadas[1], punto.coordenadas[0]];

        return {
          type: "Feature",
          geometry: {
            type: "Point",
            coordinates: coordinates,
          },
          properties: {
            id: index,
            titulo: punto.titulo,
            horario: punto.horario,
            imagen: punto.imgUrl,
            descripcion: punto.descripcion,
            telefono: punto.telefono,
            minEdad: punto.minEdad,
          },
        };
      });

      this.map.addSource("points", {
        type: "geojson",
        data: {
          type: "FeatureCollection",
          features: features,
        },
      });

      this.map.addLayer({
        id: "points",
        type: "circle",
        source: "points",
        layout: {
          visibility: "visible",
        },
        paint: {
          "circle-radius": 10,
          "circle-color": "#dfdfdf",
        },
        minzoom: 10,
        maxzoom: 18,
      });

      console.log("ACABAR DE CREAR PINES GENERALES 3/3");
    },
    crear_mostrar_pin_barcelona() {
      this.map.addLayer({
        id: "barcelona-pin",
        type: "circle",
        source: {
          type: "geojson",
          data: {
            type: "FeatureCollection",
            features: [
              {
                type: "Feature",
                geometry: {
                  type: "Point",
                  coordinates: [2.0947632393357907, 41.35567342431939],
                },
                properties: {
                  id: "barcelona-pin",
                },
              },
            ],
          },
        },
        layout: {
          visibility: "visible",
        },
        paint: {
          "circle-radius": 15,

          "circle-color": "#ff0000",
        },
      });
    },
    establecer_visibilidad_segun_zoom_pines() {
      const establecer_visibilidad_pines = () => {
        const currentZoom = this.map.getZoom();
        if (currentZoom >= 12) {
          this.map.setLayoutProperty("points", "visibility", "visible");
          this.map.setLayoutProperty("barcelona-pin", "visibility", "none");
        } else {
          this.map.setLayoutProperty("points", "visibility", "none");
          this.map.setLayoutProperty("barcelona-pin", "visibility", "visible");
        }
      };

      establecer_visibilidad_pines();

      this.map.on("zoom", () => {
        establecer_visibilidad_pines();
      });

      this.map.on("click", "barcelona-pin", () => {
        this.map.flyTo({
          center: [2.0947632393357907, 41.35567342431939],
          zoom: 12,
        });

        this.map.setLayoutProperty("barcelona-pin", "visibility", "none");
      });
    },

    añadir_popup_info_de_las_discos() {
      this.map.on("click", "points", (e) => {
        this.cerrarPopUp();
        if (e.features && e.features.length > 0) {
          const id = e.features[0].properties.id;
          if (id !== undefined && id < this.data.length) {
            this.punto_de_interes_seleccionado = true;
            this.pin_seleccionado = this.data[id];
          }
        }
      });
    },
    cerrarPopUp() {
      this.punto_de_interes_seleccionado = null;
      this.pin_seleccionado = null;
    },
    clearMarkers() {
      this.arr_puntos_de_interes.forEach((marker) => marker.remove());
      this.arr_puntos_de_interes = [];
    },
  },
};
</script>

<style>
@import url("https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css");
@import url("https://fonts.googleapis.com/css2?family=Antonio:wght@700&display=swap");

:root {
  --base: hsl(0, 5%, 16%);
  --verde: hsl(155, 81%, 46%);
  --rosa: hsl(303, 97%, 85%);
  --carne: hsl(14, 45%, 89%);
  --azul: hsl(226, 64%, 58%);
  --blanco: hsl(0, 0%, 100%);
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
  font-family: "Antonio", sans-serif;
}

.navbar {
  width: 100%;
  height: 150px;
  background-color: var(--base);
}

.navbar ul {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  list-style: none;
  height: 100%;
  color: var(--blanco);
}
.navbar > ul > li {
  font-size: 60px;
}

.navbar ul li {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.navbar ul li:hover,
.navbar ul li a:hover {
  color: var(--carne2);
}

.navbar ul li a {
  text-decoration: none;
  color: var(--blanco);
}

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

  .card-header > h3 {
    font-size: 30px;
  }

  .card-body {
    font-size: 20px;
  }
}

/* Estilos searchbar nav */

.mapboxgl-ctrl-geocoder {
  position: absolute;
  top: 40px;
  left: 10px;
  z-index: 1000;
  width: auto;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.87);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
}

.mapboxgl-ctrl-geocoder input[type="text"] {
  background-color: var(--base);
  border: none;
  color: var(--verde2);
  font-size: 1.5vw;
  padding: 10px;
}

.mapboxgl-ctrl-geocoder button {
  background-color: var(--verde2);
  font-size: 0.5vw;
  padding: 10px;
  border-radius: 20px;
}

.mapboxgl-ctrl-geocoder .suggestions {
  position: absolute;
  top: 100px;
  left: 10px;
  z-index: 1000;
  background-color: var(--verde2);
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.87);
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  color: var(--base);
}

.mapboxgl-ctrl-geocoder .suggestions li {
  list-style: none;
  padding: 10px;
  font-size: 1.2vw;
  color: var(--verde2);
  text-justify: center;
  background-color: var(--base);
  box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.87);
  margin: 14px;
  border-radius: 5px;
}
.mapboxgl-ctrl-geocoder .suggestions li:hover {
  color: var(--naranja);
  cursor: pointer;
}

.mapboxgl-ctrl-geocoder .suggestions > div > a {
  color: var(--naranja);
  text-decoration: none;
  font-size: 0;
}
</style>
