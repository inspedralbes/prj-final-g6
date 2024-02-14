<template>
    <div class="container">
      <div class="title">CRUD Reseñas</div>
  
      <!-- Mostrar reseñas existentes -->
      <div v-if="reviews.length > 0">
        <div class="title">Reseñas</div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Título</th>
              <th>Contenido</th>
              <th>Puntuación</th>
              <th>Discoteca</th>
              <th>Acciones</th> 
            </tr>
          </thead>
          <tbody>
            <tr v-for="review in reviews" :key="review.id">
              <td>{{ review.id }}</td>
              <td>{{ review.titulo }}</td>
              <td>{{ review.content }}</td>
              <td>{{ review.puntuacion }}</td>
              <td>{{ review.discoName }}</td>
              <td>
                <button class="button edit" @click="editReview(review.id)">Editar</button>
                <button class="button delete" @click="deleteReview(review.id)">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        reviews: []
      };
    },
    created() {
      this.fetchReviews();
    },
    methods: {
      async fetchReviews() {
        try {
          const response = await fetch('http://localhost:8000/api/reviews/{id}');
          if (!response.ok) {
            throw new Error(`Error al obtener las reseñas: ${response.status} - ${response.statusText}`);
          }
          this.reviews = await response.json();
          await this.getDiscoNom(); 
        } catch (error) {
          console.error('Error al obtener las reseñas:', error);
        }
      },
      async getDiscoNom() {
        await Promise.all(this.reviews.map(async (review) => {
          try {
            const response = await fetch(`http://localhost:8000/api/discotecas/${review.disco_id}`);
            if (!response.ok) {
              throw new Error(`Error al obtener el nombre de la discoteca: ${response.status} - ${response.statusText}`);
            }
            const disco = await response.json();
            review.discoName = disco.nombre_local;
          } catch (error) {
            console.error('Error al obtener el nombre de la discoteca:', error);
            review.discoName = 'Nombre no disponible';
          }
        }));
      },
      editReview(id) {
        // Implementa la lógica para editar una reseña aquí
      },
      async deleteReview(id) {
  if (confirm('¿Estás seguro de que quieres eliminar esta reseña?')) {
      const response = await fetch(`http://localhost:8000/api/reviews/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json'
        }
      });
     
  }
}

    }
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .title {
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  
  th {
    background-color: #f2f2f2;
  }
  
  .button {
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    cursor: pointer;
    margin: 5px;
  }
  
  .button.edit {
    background-color: #17a2b8;
  }
  
  .button.delete {
    background-color: #dc3545;
  }
  
  .button:hover {
    opacity: 0.8;
  }
  </style>
  