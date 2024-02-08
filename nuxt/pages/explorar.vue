<template>
    <div class="container">

        <ul class='carrusel'>
            <!-- get the random image from -->
            <li class='elemento' v-for="discoteca in data" style="background-image: url('dance2.jpg')">
                <div class='contenido'>
                    <h2 class='titulo'>{{ discoteca.nombre_local }}</h2>
                    <p class='descripcion'>
                        Lorem ipsum, dolor sit amet consectetur
                        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore
                        praesentium nisi. Id laboriosam ipsam enim.
                        Lorem ipsum, dolor sit amet consectetur
                        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore
                        praesentium nisi. Id laboriosam ipsam enim.
                        Lorem ipsum, dolor sit amet consectetur
                        adipisicing elit. Tempore fuga voluptatum, iure corporis inventore
                        praesentium nisi. Id laboriosam ipsam enim.
                    </p>
                </div>
            </li>

        </ul>
        <nav class='navegacion'>
            <button class='boton anterior' name="arrow-back-outline"></button>
            <button class='boton siguiente' name="arrow-forward-outline"></button>
        </nav>
    </div>
</template>
  
<script>


export default {
    data() {
        return {
            data: [],
            imageOptions: ['dance1.jpg', 'dance2.jpg', 'dance3.jpg']
        };
    },
    methods: {
        addEventListeners() {
            this.carrusel = this.$el.querySelector('.carrusel');

            function activar(e) {
                const elementos = document.querySelectorAll('.elemento');
                if (elementos.length > 0) {
                    e.target.matches('.siguiente') && this.carrusel.append(elementos[0]);
                    e.target.matches('.anterior') && this.carrusel.prepend(elementos[elementos.length - 1]);
                } else {
                    // Handle empty carousel (e.g., show default content or reset to the first element)
                    // For now, let's just fetch data again and render it
                    this.fetchData();
                }
            }

            document.addEventListener('click', activar.bind(this), false);
        },
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
        getRandomImage() {
            const randomIndex = Math.floor(Math.random() * this.imageOptions.length);
            const randomImage = this.imageOptions[randomIndex];
            return `url('${randomImage}')`;
        },
        prevElement() {
            const elementos = document.querySelectorAll('.elemento');
            if (elementos.length > 0) {
                this.carrusel.prepend(elementos[elementos.length - 1]);
            } else {
                // Handle empty carousel (e.g., show default content or reset to the first element)
                // For now, let's just fetch data again and render it
                this.fetchData();
            }
        },
        nextElement() {
            const elementos = document.querySelectorAll('.elemento');
            if (elementos.length > 0) {
                this.carrusel.append(elementos[0]);
            } else {
                // Handle empty carousel (e.g., show default content or reset to the first element)
                // For now, let's just fetch data again and render it
                this.fetchData();
            }
        },

    },
    mounted() {
        console.log('Component mounted. Data:', this.data);
        this.fetchData();
        this.addEventListeners();
    },
};
</script>


  
  
<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap');

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



* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {

    height: 100vh;
    display: grid;
    place-items: center;
    overflow: hidden;
}


.descripcion,
.titulo {

    text-shadow: #000000 .5px 0px 0px;
    color: #59726f;
    font-family: 'Fjalla One', sans-serif;
    font-size: 30px;
    line-height: 1.05;
    margin-left: 40px;
}

.titulo {
    font-size: 40px;
    margin-bottom: 10px;
    text-shadow: #ffffff8a .5px 0px 0px;
}




.elemento {
    width: 300px;
    height: 550px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: -1;
    background-position: center;
    background-size: cover;
    border-radius: 1000px;
    box-shadow: -2px 4px 10px 4px #0000005d;
    scale: 1.1;
    transition: 0.1s;

}



.elemento:nth-child(1),
.elemento:nth-child(2) {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    transform: none;
    border-radius: 0;
    box-shadow: none;
    opacity: 1;
}

.elemento:nth-child(3) {
    left: 45%;
}

.elemento:nth-child(4) {
    left: calc(50% + 260px);
}

.elemento:nth-child(5) {
    left: calc(50% + 615px);
}

.elemento:nth-child(6) {
    left: calc(50% + 1060px);
    opacity: 0;
}

.elemento:nth-child(n + 7) {
    display: none;
    opacity: 0;
}




.contenido {
    width: min(30vw, 400px);
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 10rem;
    opacity: 0;
    display: none;

}


.elemento:nth-of-type(2) .contenido {
    display: block;
    animation: mostrar 0.5s ease-in-out 0.5s forwards;
}

@keyframes mostrar {
    0% {
        filter: blur(5px);
        transform: translateY(-50%);
    }



    100% {
        opacity: 1;
        filter: blur(0);
    }
}

li::marker {
    color: #59726f00;

}

.navegacion {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
}

.navegacion .boton {
    background-color: #59726f;
    border: 2px solid rgba(0, 0, 0, 0.6);
    margin: 0 .5rem;
    padding: 2rem;
    border-radius: 50%;
    cursor: pointer;
}

.navegacion .boton:hover {
    background-color: rgba(255, 255, 255, 0.3);
}
</style>
  