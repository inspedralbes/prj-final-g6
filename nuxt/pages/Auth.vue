<template>
    <div>
      <h1>Nuxt.js Authentication Example</h1>
  
      <div v-if="authStore.isAuthenticated">
        <p>You are authenticated. Displaying content A.</p>
        <p>User: {{ authStore.getUser }}</p>
        <button @click="authStore.logout">Logout</button>
      </div>
  
      <div v-else>
        <p>You are not authenticated. Displaying content B.</p>
        <button @click="login">Login</button>
      </div>
    </div>
  </template>
  
  <script>
  import { useAuthStore } from "../store/auth";
  
  export default {
    setup() {
      const authStore = useAuthStore();
  
      const login = () => {
        // Implement your login logic or redirect to the login page
      };
  
      return {
        authStore,
        login,
      };
    },
  };
  </script>
  