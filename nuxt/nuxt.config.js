

export default {
  buildModules: [
    'pinia/nuxt',
    '@nuxt/http',
    
  ],
  http: {
    baseURL: 'http://localhost:8000/api',
  },
  store: '/store/index.js',
  router: {
    middleware: ['auth']
  },
};

