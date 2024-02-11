<template>
  <div class="flex justify-center items-center h-screen">
    <div class="w-96">
      <form @submit.prevent="registro" class="bg-emerald-600 shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
          <label for="nombre" class="block text-gray-100 text-sm font-bold mb-2">Nombre Completo</label>
          <input v-model="inputNombre" id="nombre" type="text" class="input" placeholder="Nombre Completo" required />
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-100 text-sm font-bold mb-2">Correo Electrónico</label>
          <input v-model="inputEmail" id="email" type="email" class="input" placeholder="Correo Electrónico"
            title="Por favor, introduce un correo electrónico válido" />
        </div>
        <div class="mb-4">
          <label for="passwrd" class="block text-gray-100 text-sm font-bold mb-2">Contraseña</label>
          <input v-model="inputPassword" id="passwrd" type="password" class="input" placeholder="Contraseña" />
        </div>
        <div class="mb-4">
          <label for="fecha_nacimiento" class="block text-gray-100 text-sm font-bold mb-2">Fecha de Nacimiento</label>
          <input v-model="inputFechaNacimiento" id="fecha_nacimiento" type="date" class="input" pattern="\d{4}-\d{2}-\d{2}"
            placeholder="Fecha de Nacimiento" required />
        </div>
        <div class="mb-4">
          <label for="telefono" class="block text-gray-100 text-sm font-bold mb-2">Número de Teléfono</label>
          <input v-model="inputTelefono" id="telefono" type="tel" class="input" placeholder="Número de Teléfono" required
            pattern="\d{9}" title="El número de teléfono debe tener 9 dígitos" />
        </div>
        
        <div class="flex justify-center text-gray-100 bg-emerald-500 p-5 hover:bg-emerald-800">
          <input type="submit" value="Registrarse" class="btn-primary" />
        </div>
      </form>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue';

const inputEmail = ref('');
const inputPassword = ref('');
const inputNombre = ref('');
const inputFechaNacimiento = ref('');
const inputTelefono = ref('');



const usuarioStore = useUsuarioStore()


definePageMeta({
  middleware: ['autentificado-redirect'],
})

const registro = async () => {
  await usuarioStore.register({
    email: inputEmail,
    passwrd: inputPassword,
    nombre: inputNombre,
    fecha_nacimiento: inputFechaNacimiento,
    telefono: inputTelefono

  });

  await navigateTo("/auth/login", { replace: true });

}
</script>

<style scoped></style>