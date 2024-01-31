<template>
    <div>
      <h1 class="titulo">Llista de discotecas</h1>
      <div v-for="discoteca in arr_discoteca" :key="discoteca.id" class="disco">
        <h2 class="nombre-discoteca">{{ discoteca.attributes.nom }}</h2>
        
        <div v-if="discoteca.attributes.descripcio" class="descripcion">
          <div v-for="parrafo in discoteca.attributes.descripcio">
            <p v-for="texto in parrafo.children">{{ texto.text }}</p>
          </div>
        </div>
         
        <div v-if="discoteca.attributes.obertura" class="horario">
          <h3>Horario:</h3>
          <div v-for="horario in discoteca.attributes.obertura">
            <p v-for="texto in horario.children">{{ texto.text }}</p>
          </div>
        </div>
        
        <h3>Edad:</h3>
        <p class="edad">{{ discoteca.attributes.edat }}</p>
        
        <h3>Imatge:</h3>
        <img v-if="discoteca.attributes.imatge?.data?.length > 0" 
             :src="'http://localhost:1337' + discoteca.attributes.imatge.data[0].attributes.url" 
             alt="" class="imagen-disco">
             
        <div class="botones">
          <buttonCreate />
          <buttonDelete :discotecaId="discoteca.id" />
          <buttonEdit :discotecaId="discoteca.id" />
        </div>
      </div>
    </div>
  </template>
  
  <style>
    * {
      box-sizing: border-box;
    }
  
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f5f5f5;
      margin: 0;
    }
    h3, p, h2{
        text-align: center;
    }
  
    .titulo {
      text-align: center;
      color: #333;
    }
  
    .disco {
      background-color: #fff;
      border: 1px solid #ddd;
      margin: 20px auto;
      padding: 20px;
      max-width: 900px; 
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }
  
    .nombre-discoteca {
      color: #007bff;
    }
  
    .descripcion,
    .horario {
      margin-top: 15px;
    }
  
    .imagen-disco {
      display: block;
      margin: 15px auto;
      max-width: 500px;
      max-height: 500px;
      height: auto;
    }
  
    .botones {
      margin-top: 20px;
    }
  </style>
  
  <script>
    import { api } from '@/utils/communicationManager';
  
    export default {
      data() {
        return {
          arr_discoteca: []
        };
      },
      methods: {},
      mounted() {
        api.getDiscotecas()
          .then((res) => {
            this.arr_discoteca = res.data;
          })
          .catch((error) => {
            console.error('Error fetching discotecas:', error);
          });
      }
    };
  </script>
  