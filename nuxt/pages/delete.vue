<template>
  <div>
    <router-link :to="{ name: 'crud' }">
        <img src="/public/img/arrow.png" alt="Imagen Botón" class="boton-imagen" width="30px" height="30px">
      </router-link>
    <h1 class="titulo">Eliminar discoteca</h1>
    <div v-for="discoteca in arr_discoteca" :key="discoteca.id" class="disco">
      <h2 class="nombre_discoteca">{{ discoteca.attributes.nom }}</h2>
      <button @click="eliminarDiscoteca(discoteca.id)">ELIMINAR</button>
    </div>
  </div>
</template>

<script>
import { api } from "@/utils/communicationManager";

export default {
  data() {
    return {
      arr_discoteca: [],
    };
  },
  methods: {
    eliminarDiscoteca(id) {
      if (confirm("¿Seguro que quieres eliminar esta discoteca?")) {
        api
          .deleteDiscoteca(id)
          .then(() => {
            this.arr_discoteca = this.arr_discoteca.filter((d) => d.id !== id);
          })
          .catch((error) => {
            console.error("Error al eliminar la discoteca:", error);
          });
      }
    },
  },
  mounted() {
    api.getDiscotecas().then((res) => {
      this.arr_discoteca = res.data;
    });
  },
};
</script>

<style lang="scss" scoped></style>
