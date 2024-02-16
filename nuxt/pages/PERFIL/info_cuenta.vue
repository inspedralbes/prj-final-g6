<template>
    <div class="info-cuenta">
      <h1>Información de la Cuenta</h1>
  
      <section class="user-details">
        <div class="profile-picture">
        <label for="fileInput">
          <input id="fileInput" type="file" @change="updateProfilePicture" accept="image/*" style="display: none">
          <img :src="profilePictureUrl" alt="Profile Picture">
        </label>
      </div>

        <div class="user-info">
          <h2>Nombre de Usuario</h2>
          <p>Email: usuario@example.com</p>
          <p>Rol: Usuario Premium</p>
          <p>Fecha de Registro: 01/01/2022</p>
        </div>
      </section>
  
      <section class="account-activity">
        <h2>Actividad de la Cuenta</h2>
        <ul>
          <li class="activity-purchase">Realizó una compra el 10/02/2024</li>
          <li class="activity-config">Cambió la configuración de la cuenta el 05/02/2024</li>
          <li class="activity-forum">Publicó en el foro el 15/02/2024</li>
          <li class="activity-mission">Completó una misión el 20/02/2024</li>
          <!-- Add more activity items as needed -->
        </ul>
      </section>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        profilePictureUrl: "/img/3128-earth.png", 
      };
    },
    methods: {
    updateProfilePicture(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          this.profilePictureUrl = reader.result;
        };
        reader.readAsDataURL(file);
      }
    },
    // Add other methods as needed
  },
};
  </script>
  
  <style scoped>
  .info-cuenta {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .user-details {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .profile-picture img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
    border: 2px solid #fff;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  }
  
  .user-info {
    flex-grow: 1;
  }
  
  .account-activity {
    h2 {
      color: #333;
      font-size: 20px;
      margin-bottom: 10px;
    }
  
    ul {
      list-style: none;
      padding: 0;
    }
  
    li {
      margin-bottom: 10px;
      padding: 10px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
  
    /* Add styles for different activity types */
    .activity-purchase {
      background-color: #e6f7ff; /* Light blue for purchases */
    }
  
    .activity-config {
      background-color: #f0f0f0; /* Light gray for configuration changes */
    }
  
    .activity-forum {
      background-color: #ffe6cc; /* Light orange for forum posts */
    }
  
    .activity-mission {
      background-color: #d9f9b1; /* Light green for mission completions */
    }
  
    /* Responsive Design */
    @media only screen and (max-width: 600px) {
      .user-details {
        flex-direction: column;
      }
  
      .profile-picture img {
        margin-right: 0;
        margin-bottom: 10px;
      }
    }
}
  </style>
  