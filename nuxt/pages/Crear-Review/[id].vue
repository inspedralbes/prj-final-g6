<template>
  <div class="container">
    <h1>Crear Reseña para la Disco {{ puntoInteresId }}</h1>
    <form @submit.prevent="submitReview">
      <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" v-model="titulo" required>
      </div>
      <div>
        <label for="content">Contenido:</label>
        <textarea id="content" v-model="content" required></textarea>
      </div>
      <div class="star-rating">
        <input type="radio" id="star5" name="rating" value="5" v-model="puntuacion" required/>
        <label for="star5" title="5 stars"></label>
        <input type="radio" id="star4" name="rating" value="4" v-model="puntuacion"/>
        <label for="star4" title="4 stars"></label>
        <input type="radio" id="star3" name="rating" value="3" v-model="puntuacion"/>
        <label for="star3" title="3 stars"></label>
        <input type="radio" id="star2" name="rating" value="2" v-model="puntuacion"/>
        <label for="star2" title="2 stars"></label>
        <input type="radio" id="star1" name="rating" value="1" v-model="puntuacion"/>
        <label for="star1" title="1 star"></label>
      </div>
      <button type="submit">Enviar Reseña</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter, useRoute } from 'vue-router'

const router = useRouter()
const route = useRoute()
const puntoInteresId = ref(route.params.id)
const titulo = ref('')
const content = ref('')
const puntuacion = ref(0)

const submitReview = async () => {
  const user_id = 1; 

  const nuevaReseña = {
    disco_id: puntoInteresId.value,
    user_id: user_id, 
    titulo: titulo.value,
    content: content.value,
    puntuacion: puntuacion.value
  }

  try {

    const response = await fetch('http://localhost:8000/api/reviews', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(nuevaReseña)
    })

    if (!response.ok) {
      throw new Error(`Error al enviar la reseña: ${response.status} - ${response.statusText}`)
    }

    console.log('Reseña enviada correctamente')
    router.push('/')
  } catch (error) {
    if (error instanceof TypeError) {
      console.error('Error de red:', error.message)
    } else {
      console.error('Error al enviar la reseña:', error.message)
    }
  }
}
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

.star-rating input[type="radio"]:checked ~ label {
  color: #ffc107;
}
</style>
