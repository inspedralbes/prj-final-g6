<template>
    <div class="body">
        <nav class="navbar">
            <ul>
                <li></li>
                <li><nuxt-link to="/">INICIO</nuxt-link></li>
                <li><nuxt-link to="/explorar">EXPLORAR</nuxt-link></li>
                <li><nuxt-link to="/perfil">PERFIL</nuxt-link></li>
            </ul>
        </nav>
        <div v-if="data.length > 0">
            <div class="carousel-container">
                <button @click="prevItem" class="arrow left-arrow">&lt;</button>
                <div class="carousel-item">
                    <h1>{{ currentDiscoteca.titulo }}</h1>
                    <p>{{ currentDiscoteca.telefono }}</p>
                    <img :src="currentDiscoteca.imgUrl" alt="Discoteca Image" />
                    <p>{{ currentDiscoteca.descripcion }}</p>
                    <p>{{ currentDiscoteca.horario }}</p>
                    <p>{{ currentDiscoteca.minEdad }}</p>
                    
                </div>
                <button @click="nextItem" class="arrow right-arrow">&gt;</button>
            </div>
        </div>
        <h3 v-else>Loading...</h3>
    </div>

    <footer>

    </footer>
</template>
  
<script>
export default {
    data() {
        return {
            data: [],
            currentIndex: 0,
            ruta_foto: null,
        };
    },
    computed: {
        currentDiscoteca() {
            return this.data[this.currentIndex] || {};
        },
    },
    methods: {
        async fetchData() {
            const response = await fetch('http://localhost:8000/api/discotecas');
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
        nextItem() {
            this.currentIndex = (this.currentIndex + 1) % this.data.length;
        },
        prevItem() {
            this.currentIndex =
                (this.currentIndex - 1 + this.data.length) % this.data.length;
        },
    },
    mounted() {
        this.fetchData();
    },
};
</script>


  
  
<style lang="scss" scoped>

/* styles for the carousel */

.carousel-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    position: relative;
}

.carousel-item {
    width: 70%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
}

.carousel-item img {
    width: 100%;
    height: 300px;
    object-fit: cover;
}

.arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
    background-color: var(--base);
    color: var(--blanco);
    border: none;
    cursor: pointer;
    padding: 10px 20px;
    z-index: 1;
}

.left-arrow {
    left: 0;
}

.right-arrow {
    right: 0;
}







*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Antonio', sans-serif;
    overflow: hidden;
}


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

.body {
    margin: 0;
    padding: 0;
    font-family: 'Antonio', sans-serif;
    background-color: var(--carne2);
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

.navbar>ul>li {
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
</style>
  