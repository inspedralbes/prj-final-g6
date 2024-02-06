<template>
    <div id="app">
      <div class="profile-container">
        <h1>Editar perfil</h1>
        <form @submit.prevent="updateProfile" class="profile-form">
          <div class="form-group">
            <label for="name">Nombre:</label>
            <input id="name" v-model="user.name" type="text" />
          </div>
  
          <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input id="email" v-model="user.email" type="email" />
          </div>
  
          <button type="submit">Guardar cambios</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        user: {
          name: '',
          email: ''
        }
      };
    },
    mounted() {
      this.fetchUserData();
    },
    methods: {
      async fetchUserData() {
        try {
          const response = await fetch('/user-profile');
          const userData = await response.json();
          this.user = userData.data;
        } catch (error) {
          console.error('Error al obtener los datos del usuario:', error);
        }
      },
      updateProfile() {
        // Aquí puedes hacer una petición a tu API de Laravel para actualizar los datos del usuario
        console.log('Datos del usuario actualizados:', this.user);
      }
    }
  };
  </script>
  
  <style scoped>
  #app {
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  
  .profile-container {
    max-width: 400px;
    margin: 0 auto;
  }
  
  .profile-form {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  label {
    font-weight: bold;
  }
  
  input {
    padding: 8px;
    margin-top: 5px;
    width: 100%;
    box-sizing: border-box;
  }
  
  button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 15px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  button:hover {
    background-color: #2980b9;
  }
  </style>
  