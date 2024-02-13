<template>

    <div class="container">
      <div class="title">Crear Reseña para la Disco {{ puntoInteresId }}</div>
      <form @submit.prevent="submitReview" class="form">
        <input type="text" v-model.trim="titulo" class="input" placeholder="Título" required />
        <textarea v-model.trim="content" class="input" placeholder="Contenido" required></textarea>
        <div class="star-rating">
          <input type="radio" id="star5" name="rating" value="5" v-model="puntuacion" required />
          <label for="star5" title="5 stars"></label>
          <input type="radio" id="star4" name="rating" value="4" v-model="puntuacion" />
          <label for="star4" title="4 stars"></label>
          <input type="radio" id="star3" name="rating" value="3" v-model="puntuacion" />
          <label for="star3" title="3 stars"></label>
          <input type="radio" id="star2" name="rating" value="2" v-model="puntuacion" />
          <label for="star2" title="2 stars"></label>
          <input type="radio" id="star1" name="rating" value="1" v-model="puntuacion" />
          <label for="star1" title="1 star"></label>
        </div>
        <button type="submit" class="button">Enviar Reseña</button>
      </form>

    </div>

</template>

<script>


export default {
  data() {
    
    return {
      usuario_id: 1,
      titulo: '',
      puntuacion: 0,
      content: ''
    };
  },

  methods: {
    submitReview() {
      fetch('http://localhost:8000/api/reviews', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',

        },
        body: JSON.stringify({
          disco_id: this.puntoInteresId,
          usuario_id: this.usuario_id,
          titulo: this.titulo,
          puntuacion: this.puntuacion,
          content: this.content
        }),
      })
        .then(response => {
          if (!response.ok) {
            throw new Error(`Error al enviar la reseña: ${response.status} - ${response.statusText}`);
          }
          console.log('Reseña enviada correctamente');
          navigateTo('/');
        })
        .catch(error => {
          console.error('Error al enviar la reseña:', error);
        });
    }
  },
  created() {
    this.puntoInteresId = this.$route.params.id;
  }
};
</script>

<style scoped>
.container {
  max-width: 600px;
  margin: 0 auto;
}

label {
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
textarea {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
}

.star-rating {
  unicode-bidi: bidi-override;
  direction: rtl;
  text-align: center;
}

.star-rating input[type="radio"] {
  display: none;
}

.star-rating label {
  display: inline-block;
  padding: 5px;
  font-size: 30px;
  color: #ccc;
  cursor: pointer;
}

.star-rating label:before {
  content: '★';
}

.star-rating input[type="radio"]:checked~label {
  color: #ffc107;
}
</style>
