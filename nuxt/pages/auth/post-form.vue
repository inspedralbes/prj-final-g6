<template>
  <div>
    <h1>LOGIN O RESGISTRO SUCCESFUL</h1>
    <button @click="moveTo__register">Ir a registrarse</button>
    <button @click="moveTo__login">Ir a login</button>
  </div>
</template>

<script lang="ts" setup>


definePageMeta({
    middleware: ['no-autentificado-redirect'],
})

const moveTo__register = () => {
  navigateTo("/auth/register", { replace: true });
}
const moveTo__login = () => {
  navigateTo("/auth/login", { replace: true });
}

</script>

<style></style>