<template>
    <div class="body">
        <div class="container">
            <header>
                <h1>AJUSTES</h1>

                <li class="li-search-i-holder">
                    <input type="text" placeholder="Search" class="searchbar">
                    <i class="material-icons">search</i>
                </li>

                <li @click="cambiar_tema"><i class="material-icons">contrast</i></li>

                <li><i class="material-icons">account_circle</i></li>

            </header>

            <aside>
                <ul>
                    <li @click="navigateTo_ajustes"><i class="material-icons">settings</i></li>
                    <li @click="navigateTo_favoritos"><i class="material-icons">star</i></li>
                    <li @click="navigateTo_vista"><i class="material-icons">visibility</i></li>
                    <li @click="navigateTo_info_cuenta"><i class="material-icons">person</i></li>
                    <li @click="navigateTo_chats"><i class="material-icons">chat</i></li>
                </ul>

            </aside>

            <form action="">
                <div class="form-group">
                    <h1>Informacio Bàsica</h1>
                    <p>Posa el teu nom i canvia la teva icona</p>

                    <div class="form-group-info-basica">
                        <label for="nombre">Nom del compte</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                        <label for="foto">Foto de perfil</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>
    
                  
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="confirm-password">Confirmar Contraseña:</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="form-control">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="tel" id="telefono" name="telefono" class="form-control">
                </div>

                <div class="form-group">
                    <label for="fecha-nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" id="fecha-nacimiento" name="fecha-nacimiento" class="form-control">
                </div>
            </form>






        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            nombre: '',
            email: '',
            password: '',
            confirm_password: '',
            telefono: '',
            fecha_nacimiento: ''

        }
    },
    methods: {
        async editar() {
            try {
                const response = await fetch(`http://localhost:8000/api/users/${this.user_id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        nombre: this.nombre,
                        phone: this.telefono,
                        birthdate: this.fecha_nacimiento,
                        email: this.email,
                        password: this.password,
                        password2: this.confirm_password,
                    }),
                });
                const data = await response.json();
                console.log(data);
                navigateTo('main');
            } catch (error) {
                console.error(error);
            }

        },
    }
}
</script>

<style lang="scss" scoped>
form{
    grid-area: form;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-template-areas: 
    "info-basica email seguretat"
}
/* ESTILOS GLOBALES ------------------------------------------------------------------------------------  */

@import url('https://fonts.googleapis.com/icon?family=Material+Icons');

header h1 {
    font-size: 60px;
    color: #723d3d;
    font-weight: 700;
    padding-left: 30px;
}

li {
    list-style: none;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-size: 30px;
}

.body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #dbdada;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;

}

.container {
    display: grid;
    grid-template-columns: 0.33fr 1fr 1fr 1fr 1fr;
    grid-template-areas:

        "header header header header header"
        "aside form form form form"

    ;
    grid-template-rows: auto 3fr;
    background-color: rgb(235, 225, 228);
    border-radius: 16px;
    padding: 20px;

}

.container header {
    grid-area: header;
    display: flex;
    justify-content: space-between;
    align-items: center;

    background-color: #c28383;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
    border-bottom-left-radius: 0px;
    border-bottom-right-radius: 0px;
    border-bottom: 3px solid #4d12123d;
}

.container header * {
    margin: 10px;
}

aside {
    display: flex;
    flex-direction: column;
    background-color: #c28383;
    grid-area: aside;
}

aside li {
    padding: 10px;
    margin-top: 30px;
    background-color: #4d12123d;
    border-radius: 50%;
    height: auto;
    width: 80px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-left: auto;
    margin-right: auto;
}

aside li i {
    color: #723d3d;
    margin-left: auto;
    margin-right: auto;
}

aside li i:hover {
    color: #dfd9d9;

}

.searchbar {
    padding: 15px;
    border-radius: 16px;
    min-width: 700px;
    border: none;
    background-color: #fcfcfcf5;
    color: #834545;
    font-size: 40px;
    font-weight: 700;
    margin: auto;
}

.li-search-i-holder {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;

}

.searchbar::placeholder {
    color: #834545;
    font-size: 40px;
    font-weight: 700;
    margin: auto;
}

.searchbar:focus {
    outline: none;
    border: 3px solid #723d3d;
}

i {
    font-size: 60px;
}

/* ESTILOS GLOBALES ------------------------------------------------------------------------------------  */
</style>