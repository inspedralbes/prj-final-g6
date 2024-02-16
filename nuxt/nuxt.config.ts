export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: [
    '@pinia/nuxt',
    "@nuxtjs/tailwindcss",
    "@formkit/auto-animate",
  ],
  buildModules: ['nuxt-use-sound'],  
  pinia: {
    autoImport: ["defineStore"]
  },
  imports: {
    dirs: ["./stores"],
  },
  sound: {
    back: {
      src: "/back.wav",
      options: {
        volume: 0.25
      }
    }
  }
});
