<template>
    <div class="loader">
      <!-- Puedes personalizar la apariencia del loader según tus preferencias -->
      <div class="spinner"></div>
    </div>
  </template>
  
  <style scoped>
  .loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9); /* Fondo blanco semi-transparente */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000; /* Asegúrate de que el loader esté en la parte superior */
  }
  
  .spinner {
    border: 8px solid #f3f3f3; /* Color del borde del spinner */
    border-top: 8px solid #3498db; /* Color del borde superior del spinner (puedes cambiarlo) */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite; /* Animación giratoria */
  }
  
  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  </style>
  