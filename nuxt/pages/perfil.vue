<template>
    <div class="container">
        <div class="profile">

            <div class="profile-image">
                <img src="../public/img/3128-earth.png">

            </div>
            <div class="profile-name">
                <h1>Bienvenido a Viaegis</h1>
                <div v-if="user" class="user-details">
                    <p class="usuarioestilo">Bienvenido <span class="user-name">{{ user.nombre }}</span> (<span class="user-email">{{ user.email
                    }}</span>)!</p>
                    <!-- Otros detalles del usuario que desees mostrar -->
                </div>
                <div v-else>
                    <p>Bienvenido Invitado!</p>
                </div>
            </div>

            <div class="profile-btns">
                <a href="#"><img src="https://via.placeholder.com/30"></a>
                <a href="#"><img src="https://via.placeholder.com/30"></a>
                <a href="#"><img src="https://via.placeholder.com/30"></a>
                <a href="#"><img src="https://via.placeholder.com/30"></a>
            </div>
        </div>
    </div>









   
</template>
  
<script>
export default {
    name: 'Welcome',
    data() {
        return {
            user: null,
        };
    },
    created() {
        if (typeof localStorage !== 'undefined') {
            const storedAuthToken = localStorage.getItem('authToken');
            if (storedAuthToken) {
                this.fetchUserDetails(storedAuthToken);
            }
        } else {
            console.error('localStorage is not available in this environment.');
        }
    },
    methods: {
        fetchUserDetails(authToken) {
            fetch('http://localhost:8000/api/user', {
                headers: {
                    'Authorization': 'Bearer ' + authToken,
                },
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    this.user = data;
                })
                .catch(error => {
                    console.error('Error fetching user details:', error);
                });
        },
    },
};
</script>
  
<style>

    /* import google Fjalla one  */
    @import url('https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap');

    :root {
        /* #c0cfd4  #6b7474  #041479  #37a681  #134333  #546f8b  #6783c0  #05060f  #61676a  #8c8c91  #3f4949  #238970  #8c948c  #172626  #21614b  #042411  #1a3b51 */
        /* establish colours with meaningful names */
        --light-grey: #c0cfd4;
        --dark-grey: #6b7474;
        --blue: #041479;
        --green: #37a681;
        --dark-green: #134333;
        --light-blue: #546f8b;
        --lighter-blue: #6783c0;
        --black: #05060f;
        --grey: #61676a;
        --lighter-grey: #8c8c91;
        --darker-grey: #3f4949;
        --darker-green: #238970;
        --lighter-darker-grey: #8c948c;
        --darker-blue: #172626;
        --darker-lighter-green: #21614b;
        --darker-darker-blue: #042411;
        --darker-darker-lighter-green: #1a3b51;

    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Fjalla One', sans-serif;
        font-size: 16px;
    }
.usuarioestilo{
    color: var(--light-grey);
    font-size: large;
}
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: var(--light-blue);
        
    }

    .profile {
        display: flex;
        flex-direction:column;
        align-items: center;
        padding: 10px;
        border-radius: 20px;
        box-shadow: 3px 3px 2px var(--lighter-grey);
        background: var(--blue);
        animation: profileAnimation .7s infinite alternate ease-in-out;
    }

    @keyframes profileAnimation {
        0% {
            transform: translateY(0);
        }
        100% {
            transform: translateY(10px);
        }
    }

    .profile-name h1 {
        margin: 40px;
        color: var(--grey);
        transform: translate(0, -50px);
        animation: aparecer 0.5s ease-out;
    }

    .profile-btns a {
        display: inline-block;
        margin: 30px;
    }

    .profile-btns img {
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
        transform: translate(0, -10px);
        animation: aparecer 0.5s ease-out;
    }    

      

    .profile-image img {
        width: 150px;
        height: auto;
        
        /* border-radius: 50%; */
        margin-bottom: 40px;
        object-fit: cover;
        transform: translate(0, 30px);
        animation: aparecer 0.5s ease-out;
      
        transform: translate(0, -100px) scale(2);
      
    }
    
    
    

 

    @keyframes aparecer {
        0% {
            opacity: 0;
            transform: translateY(100px);
        }
        100% {
            opacity: 1;
        }
    }

    


    .profile-btns img {
     width: 40px;
     height: 40px;
     object-fit: cover;
     border-radius: 50%;
    }


    .profile-btns a:nth-child(1) img {
        animation-delay: 0.1s;
    }

    .profile-btns a:nth-child(2) img {
        animation-delay: 0.2s;
    }

    .profile-btns a:nth-child(3) img {
        animation-delay: 0.3s;
    }

    .profile-btns a:nth-child(4) img {
        animation-delay: 0.4s;
    }


  
</style>
  