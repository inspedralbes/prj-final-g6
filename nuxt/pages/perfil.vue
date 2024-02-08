<template>
    <div class="container">
        <div class="profile">

            <div class="profile-image">
                <img src="https://i.pinimg.com/236x/71/b5/30/71b530741316eb38be5e8bb582fa6a86.jpg">

            </div>
            <div class="profile-name">
                <h1>Bienvenido a Viaegis</h1>
                <div v-if="user" class="user-details">
                    <p :class="{ usuarioestilo: true }">Bienvenido <span :class="{ 'user-name': true }">{{ user.nombre
                    }}</span> (<span :class="{ 'user-email': true }">{{ user.email }}</span>)!</p>

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
  
<style scoped>
/* import google Fjalla one  */
@import url('https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap');


* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Fjalla One', sans-serif;
    font-size: 16px;
}

.usuarioestilo {
    color: rgb(0, 0, 0);
    font-size: large;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #b0afafb8;
}


.profile {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    border-radius: 20px;
    box-shadow: 1px 3px 3px 2px #a4a4ae;
    background: lightblue;
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
    color: gray;
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
  