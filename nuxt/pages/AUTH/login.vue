<template>
    <div class="container flex items-center justify-center bg-emerald-600">
        <div>
            <form @submit.prevent="login">
                <input v-model="inputEmail" id="email" type="email" class="input" placeholder="Correo Electrónico"
                    title="Por favor, introduce un correo electrónico válido" />
                    <br>
                    <br>
                    
                <input v-model="inputPassword" id="passwrd" type="password" class="input" placeholder="Contraseña" />
                <input type="submit" value="" placeholder="SUBMIT">
            </form>
        </div>
    </div>
</template>
  
<script lang="ts" setup>
import { ref } from 'vue';

const inputEmail = ref('');
const inputPassword = ref('');

const usuarioStore = useUsuarioStore()


definePageMeta({
    middleware: ['autentificado-redirect'],
})

const login = async () => {
    await usuarioStore.login({
        email: inputEmail,
        password: inputPassword
    });

    await navigateTo("/auth/post-form", { replace: true });

}
</script>
  
<style scoped></style>