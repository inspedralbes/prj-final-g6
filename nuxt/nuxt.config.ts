
export default defineNuxtConfig({
  devtools: { enabled: true },
  css: [
    'leaflet/dist/leaflet.css',
  ],
  http: {
    baseURL: 'http://localhost:8000/api', // Ajusta la URL base según tu configuración
  },
  buildModules: ['@nuxt/http'],
});