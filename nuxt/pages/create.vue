<template>
    <div>
      <router-link :to="{ name: 'crud' }">
        <img src="/public/img/arrow.png" alt="Imagen Botón" class="boton-imagen" width="30px" height="30px">
      </router-link>
      <form @submit.prevent="submitForm">
        <div>
          <label for="nom">Nom:</label>
          <input v-model="nom" type="text" id="nom" name="nom" />
        </div>
        <div>
          <label for="descripcio">Descripció:</label>
          <textarea v-model="descripcio" id="descripcio" name="descripcio"></textarea>
        </div>
        <div>
          <label for="edat">Edat:</label>
          <input v-model="edat" type="text" id="edat" name="edat" />
        </div>
        <div>
          <label for="obertura">Horari:</label>
          <textarea v-model="obertura" id="obertura" name="obertura"></textarea>
        </div>
        <div>
          <label for="tel">Telefon:</label>
          <input v-model="tel" type="text" id="tel" name="tel" />
        </div>
        <button type="submit">Enviar Formulario</button>
      </form>
    </div>
  </template>
  
  <script>
import { api } from '@/utils/communicationManager';

  export default {

    data() {
      return {
        nom: '',
        descripcio: '',
        edat: '',
        obertura: '',
        tel: '',
      };
    },
    methods: {
       
      async submitForm() {
        const payload= {
                    data: {
                    nom: this.nom,
                    descripcio: this.descripcio,
                    edat: this.edat,
                    obertura: this.obertura,
                    tel: this.tel,
                    },
                };
       
          api.createDiscoteca(payload).then((res) => {
            console.log('Discoteca creada:', res);            
          })
          .catch((error) => {
            console.error('Error creando discotecas:', error);
          });
          
        
      },
    },
  };
  </script>
  