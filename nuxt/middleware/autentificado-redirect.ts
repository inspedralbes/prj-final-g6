export default defineNuxtRouteMiddleware(async (to, from) => {
    const usuarioStore = useUsuarioStore();
  
    // User logged in and not on the 'autentificado/post-form' route
    if (!!usuarioStore.user && to.path !== '/AUTH/post-form/') {
      return await navigateTo('/AUTH/post-form/');
    }
  });
  