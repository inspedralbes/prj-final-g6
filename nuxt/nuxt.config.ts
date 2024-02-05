// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  css: [
    'leaflet/dist/leaflet.css',
  ],
  buildModules: ['@nuxt/http'],
  http: {
    baseURL: 'http://localhost:8000/api', // Ajusta la URL base según tu configuración
  },

})
