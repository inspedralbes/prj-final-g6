
export default defineNuxtConfig({
  devtools: { enabled: true },
  css: ['leaflet/dist/leaflet.css'],
  http: {
    baseURL: 'http://projectefinalg6.daw.inspedralbes.cat',
  },
  buildModules: ['@nuxt/http'],
});
