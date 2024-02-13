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
          <button class="scroll-button" @click="scrollFriendsList">▼</button>

          <!-- Add more friend items as needed -->
        </div>


      </div>
    </aside>
    <header class="dashboard-header">
      <div class="user-info">
        <div class="profile-avatar">
          <img src="../img/horse.png" alt="User Profile Picture" class="profile-img">
        </div>
        <div class="user-details">
          <div class="profile-name">John Doe</div>
          <div class="profile-bio">Web Developer | Explorer</div>
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
      <!-- SECTION 2: Latest News -->
      <div class="latest-news">
        <h2>Latest News</h2>
        <div class="news-item">
          <h3>Exciting Announcement</h3>
          <p>Stay tuned for our upcoming event!</p>
        </div>
        <div class="news-item">
          <h3>New Feature Released</h3>
          <p>Explore the latest features in our platform.</p>
        </div>
        <!-- Add more news items as needed -->
      </div>
    </section>

    <section>

    </section>
    <main>
      <!-- MAIN CONTENT: You can add your main content here -->
      <div class="main-content">
        <h2>Main Content Area</h2>
        <p>Welcome to the main section of your dashboard.</p>
        <!-- Add more content as needed -->
      </div>
    </main>

    <footer>FOOTER</footer>
  </div>
</template>

<script>
export default {
  methods: {
    scrollFriendsList() {
      const friendList = document.querySelector('.friend-list');
      friendList.scrollTop += 50; // Ajusta la cantidad de desplazamiento según tu diseño
    }
  }
};
</script>


<style lang="scss" scoped>
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

.dashboard-header {
  grid-area: header;
  background-color: #91c8ff;
  margin-bottom: -9%;
  position: relative;
}

.profile {
  position: relative;
  height: 40vh;
  min-height: 250px;
  max-height: 350px;
  z-index: 1;

  &-cover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 4px;
  }

  &:before {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    z-index: -1;
    left: 0;
    top: 0;
    background-image: url("https://images.unsplash.com/photo-1508247967583-7d982ea01526?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    filter: blur(50px);
    opacity: 0.7;
  }
}

.profile-menu {
  position: absolute;
  bottom: 0;
  padding-left: 200px;
  background: #a8a840;
  /* Replace with your actual background color */
  width: 100%;
  display: flex;
  border-radius: 0 0 4px 4px;
}


.profile-menu-link {
  padding: 20px 16px;
  color: side-title;
  transition: 0.3s;
  cursor: pointer;

  &.active,
  &:hover {
    color: #fff;
    background-color: #1b1d2e;
    border-bottom: 3px solid #1488fa;
  }
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
  background-color: #91c8ff;
}

section:nth-of-type(1) {
  grid-area: sect1;
  background-color: #b3d8fd;
  margin-top: 27%;
}

section:nth-of-type(2) {
  grid-area: sect2;
  background-color: #5e86af;
  margin-top: 27%;
}

section:nth-of-type(3) {
  grid-area: sect3;
  background-color: #6d9fd2;
  margin-top: 27%;
}

main {
  grid-area: main;
  background-color: #7da9d5;
}

footer {
  grid-area: footer;
  background-color: #588ec3;
}

.friends {
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

.friend-list {
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
</style>
