export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    "@nuxtjs/tailwindcss",
    "@formkit/auto-animate",
  ],
  pinia: {
    autoImport: ["defineStore"]
  },
  imports: {
    dirs: ["./stores"],
  },
 
});