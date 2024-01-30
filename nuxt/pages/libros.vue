
<template>
    <div>
        <h1 class="titulo">Llista de llibres</h1>
        <div v-for="llibre in arr_libros" :key="llibre.id" class="libro">
            <h2>{{ llibre.attributes.title }} {{ llibre.attributes.date_of_pub }}</h2>
            <p>{{ llibre.attributes.description }}</p>
            <img :src="'http://localhost:1337' + llibre.attributes.Ilustration.data.attributes.url" alt=""
                class="imagen-libro">

        </div>
    </div>
</template>
    
<style>
* {
    text-align: center;
}

.imagen-libro {
    margin-left: auto;
    margin-right: auto;
    display: flex;
    width: 200px;
   
}
</style>
  
<script>
import { api } from '@/utils/communicationManager';

export default {
    data() {
        return {
            arr_libros: []
        }
    },
    methods: {

    },
    mounted() {
        api.getLlibres().then((res) => {
            this.arr_libros = res.data;
            console.log(this.arr_libros);
        })

    }
}
</script>
