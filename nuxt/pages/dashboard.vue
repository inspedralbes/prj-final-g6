<template>
  <div class="dashboard">
    <aside>
      <div class="logo">FluxFiesta</div>
      <div class="side-wrapper">
        <div class="side-title">MENU</div>
        <div class="side-menu">
          <a href="#">
            <i class="fas fa-home"></i> Home
          </a>
          <a href="#">
            Latest News
          </a>
          <a href="#">
            Explore
          </a>
          <a href="#">
            Files
          </a>
          <a href="#">
            Galery
          </a>
          <a href="#">
            Events
          </a>
        </div>
      </div>
      <div class="friends">
        <h2>Friends</h2>
        <div class="friend-list">
          <div class="friend-item">
            <img src="../img/horse.png" alt="Friend 1" class="friend-avatar">
            <div class="friend-details">
              <div class="friend-name">Rubén Cerezón</div>
              <div class="friend-status">Online</div>
            </div>
          </div>
          <div class="friend-item">
            <img src="../img/horse.png" alt="Friend 2" class="friend-avatar">
            <div class="friend-details">
              <div class="friend-name">José el cervezas</div>
              <div class="friend-status">Away</div>
            </div>
          </div>
          <div class="friend-item">
            <img src="../img/horse.png" alt="Friend 2" class="friend-avatar">
            <div class="friend-details">
              <div class="friend-name">Pol Granch</div>
              <div class="friend-status">Away</div>
            </div>
          </div>

          <!-- Add more friend items as needed -->
        </div>


      </div>
    </aside>
    <header class="dashboard-header">
      <div class="user-info">
        <div class="profile-avatar">
          <img :src="getProfileImage()" alt="User Profile Picture" class="profile-img">
        </div>
        <div class="user-details">
          <div class="profile-name">John Doe</div>
          <div class="profile-bio">Web Developer | Explorer</div>

          <!-- Add input field for profile picture upload -->
          <input type="file" accept="image/*" @change="handleProfileImageChange" />
          <button @click="uploadProfileImage">Upload</button>
        </div>
      </div>

    </header>

    <section><!-- SECTION 1: Profile Info -->
      <div class="profile-info">
        <h2>Profile Info</h2>
        <div class="info-field">
          <strong>Email:</strong> john.doe@example.com
        </div>
        <div class="info-field">
          <strong>Location:</strong> City, Country
        </div>
        <!-- Add more fields as needed -->
      </div>
    </section>
    <section>
    <!-- SECTION 2: Galería de Fotos -->
    <div class="photo-gallery">
      <h2>Galería de Fotos</h2>
      <div class="gallery-container">
        <div v-for="(photo, index) in photoGallery" :key="index" class="gallery-item">
          <img :src="photo.url" :alt="photo.caption" class="gallery-img">
          <div class="photo-caption">{{ photo.caption }}</div>
        </div>
      </div>
      <div class="add-photo">
        <input type="file" accept="image/*" @change="handlePhotoUpload">
        <input v-model="newPhotoCaption" placeholder="Añade una descripción">
        <button @click="uploadPhoto">Subir Foto</button>
      </div>
    </div>
  </section>
   <section>
    <!-- SECTION 2: Actividades Recientes -->
    <div class="recent-activities">
      <h2>Actividades Recientes</h2>
      <ul class="activity-list">
        <li>
          <i class="fas fa-check-circle"></i> Publicaste una nueva foto en la galería.
        </li>
        <li>
          <i class="fas fa-comment"></i> Comentaste en el evento "Fiesta Electro" de este fin de semana.
        </li>
        <li>
          <i class="fas fa-heart"></i> Le diste "Me gusta" a la foto de Rubén Cerezón.
        </li>
        <!-- Agrega más elementos según sea necesario -->
      </ul>
    </div>
  </section>
    <main>
      <hr>
      <div class="main-content">
        <h2>Tus Discotecas Frecuentes</h2>
        <div class="club-list">
          <div class="club-item">
            <img src="https://fondosmil.co/fondo/30992.jpg" alt="Club 1" class="club-img">
            <div class="club-details">
              <div class="club-name">Club Fiesta</div>
              <div class="club-location">City, Country</div>
            </div>
          </div>
          <div class="club-item">
            <img src="https://fondosmil.co/fondo/30992.jpg" alt="Club 2" class="club-img">
            <div class="club-details">
              <div class="club-name">Electro Lounge</div>
              <div class="club-location">City, Country</div>
            </div>
          </div>
          <div class="club-item">
            <img src="https://fondosmil.co/fondo/30992.jpg" alt="Club 2" class="club-img">
            <div class="club-details">
              <div class="club-name">Electro Lounge</div>
              <div class="club-location">City, Country</div>
            </div>
          </div>

          <!-- Add more club items as needed -->
        </div>
      </div>
    </main>

    <footer>FOOTER</footer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      photoGallery: [
        { url: '../img/horse.png', caption: 'Beautiful Sunset' },
        { url: '../img/horse.png', caption: 'Adorable Pets' },
        // Add more photo items as needed
      ],
      newPhotoFile: null,
      newPhotoCaption: '',
      newProfileImage: null,

    };

  },
  methods: {
    uploadPhoto() {
      // Logic to handle photo upload
      // You can add the new photo to the photoGallery array
      // and reset the form fields afterward
      this.photoGallery.push({
        url: 'path/to/newphoto.jpg',
        caption: this.newPhotoCaption,
      });
      this.newPhotoFile = null;
      this.newPhotoCaption = '';
    },
    handleProfileImageChange(event) {
      this.newProfileImage = event.target.files[0];
    },
    async uploadProfileImage() {
      if (!this.newProfileImage) {
        // Handle the case where no image is selected
        return;
      }

      try {
        // Logic to handle profile image upload
        // You can use a service or API call to upload the image
        // Update the user's profile image URL or handle it as needed
        // For now, we'll assume the image upload is successful
        const imageUrl = 'path/to/newprofileimage.jpg';

        // Update the profile image URL in the data
        // You can use this URL to display the updated profile image
        this.$set(this.$data, 'profileImageUrl', imageUrl);

        // Reset the form field
        this.newProfileImage = null;
      } catch (error) {
        // Handle errors during the image upload process
        console.error('Error uploading profile image:', error);
      }
    },

    // Function to get the profile image URL (display the uploaded or default image)
    getProfileImage() {
      return this.newProfileImage ? URL.createObjectURL(this.newProfileImage) : '../img/horse.png';
    },
    handlePhotoUpload(event) {
      // Manejar la carga de nuevas fotos
      this.newPhotoFile = event.target.files[0];
    },
    uploadPhoto() {
      // Lógica para manejar la carga de fotos
      if (!this.newPhotoFile) {
        // Manejar el caso donde no se ha seleccionado ninguna imagen
        return;
      }
      try {
        // Simulamos la carga de la foto y la añadimos a la galería
        const imageUrl = URL.createObjectURL(this.newPhotoFile);

        this.photoGallery.push({
          url: imageUrl,
          caption: this.newPhotoCaption,
        });

        // Reiniciar los campos después de la carga
        this.newPhotoFile = null;
        this.newPhotoCaption = '';
      } catch (error) {
        // Manejar errores durante el proceso de carga de la foto
        console.error('Error al cargar la foto:', error);
      }
    },
  },
};
</script>


<style lang="scss" scoped>
.photo-gallery {
  padding: 20px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 20px;

  h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  .gallery-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .gallery-item {
    width: calc(33.333% - 20px);
    overflow: hidden;
    border-radius: 8px;
    position: relative;

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
    }

    .photo-caption {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      color: #fff;
      padding: 8px;
      text-align: center;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
      font-size: 14px;
    }
  }

  .add-photo {
    margin-top: 20px;
    display: flex;
    align-items: center;

    input[type="file"] {
      margin-right: 10px;
    }

    button {
      background-color: #007FFF;
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
    }
  }
}
  .recent-activities {
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 20px;

    h2 {
      font-size: 20px;
      margin-bottom: 10px;
    }

    .activity-list {
      list-style-type: none;
      padding: 0;

      li {
        margin-bottom: 10px;
        display: flex;
        align-items: center;

        i {
          margin-right: 10px;
          font-size: 18px;
          color: #007FFF; /* Color para los iconos, puedes ajustarlo */
        }
      }
    }
  }
.main-content {
  padding: 20px;
}

.section-title {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

.club-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;

  .club-item {
  flex: 0 0 calc(33.333% - 20px);
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s ease-in-out;  /* Agregamos la transición */

  &:hover {
    transform: scale(1.05);  /* Escala al pasar el ratón sobre la tarjeta */
  }

  .club-img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }

  .club-details {
    padding: 15px;

    .club-name {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
    }

    .club-location {
      font-size: 14px;
      color: #666;
    }
  }
}
}

.photo-item {
  margin-bottom: 20px;
  width: 9px;
}

.gallery-img {
  max-width: 100%;
  height: auto;
  border-radius: 4px;
}

.photo-caption {
  margin-top: 8px;
  font-size: 14px;
  color: #555;
}

.scroll-button {
  background-color: #007FFF;
  color: #fff;
  border: none;
  padding: 10px;
  border-radius: 4px;
  cursor: pointer;
}

.profile-info {
  padding: 20px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 20px;

  h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  .info-field {
    margin-bottom: 10px;
  }
}

.user-info {
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding: 16px;


  .profile-avatar {
    margin-right: 12px;
  }

  .user-details {
    display: flex;
    flex-direction: column;
    text-align: right;

    .profile-name {
      font-size: 18px;
      color: #fff;
      font-weight: 600;
    }

    .profile-bio {
      font-size: 14px;
      color: #fff;
    }
  }
}
.dashboard-section {
  padding: 20px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 20px;

  h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }
}
.dashboard-header {
  grid-area: header;
  background-color: #a1c4e7;
  margin-bottom: -9%;
  position: relative;
}







.profile-img {
  width: 115px;
  height: 115px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid bg-color;
}



.side-wrapper {
  padding: 30px;
}

.side-title {
  font-family: title-font;
  color: side-title;
  font-size: 15px;
  font-weight: 600;
  margin-bottom: 20px;
}

.side-menu {
  display: flex;
  flex-direction: column;
  font-size: 15px;
  white-space: nowrap;

}

.dashboard {
  height: 100vh;
}

.dashboard {
  height: 100vh;
  margin: 0;
  display: grid;
  grid-template-columns: 100%;
  grid-template-rows: repeat(5, auto);
  grid-template-areas:
    "header"
    "sect1"
    "sect2"
    "sect3"
    "main"
    "footer";
}

@media only screen and (min-width: 500px) {
  .dashboard {
    margin: 0;
    display: grid;
    grid-template-columns: auto 27% 27% 27%;
    grid-template-rows: 8% 30% auto 10%;
    grid-template-areas:
      "sidebar header header header"
      "sidebar sect1 sect2 sect3"
      "sidebar sect1 sect2 sect3"
      "sidebar main main main"
      "sidebar main main main"
      "sidebar footer footer footer";
  }
}


aside {
  grid-area: sidebar;
  background-color: #007FFF;
}

header {
  grid-area: header;
}

section:nth-of-type(1) {
  grid-area: sect1;
 // background-color: #1a1b1d;
  margin-top: 27%;
}

section:nth-of-type(2) {
  grid-area: sect2;
  //background-color: #1a1b1d;
  margin-top: 27%;
}

section:nth-of-type(3) {
  grid-area: sect3;
  //background-color: #1a1b1d;
  margin-top: 27%;
}

main {
  grid-area: main;
 // background-color: #7da9d5;
}

footer {
  grid-area: footer;
  background-color: #610dc0;
}

.friends {
  padding: 20px;
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 9px;

  h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  .friend-list {
    max-height: 200px;
    /* Set a fixed height for the friend list container */
    overflow-y: auto;
    /* Enable vertical scrolling */
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .friend-item {
    display: flex;
    align-items: center;
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 4px;
min-width: 200px;
    .friend-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 10px;
    }

    .friend-details {
      flex-grow: 1;

      .friend-name {
        font-weight: 600;
      }

      .friend-status {
        color: #888888;
      }
    }
  }
}</style>
