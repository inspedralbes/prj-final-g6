export default defineNuxtRouteMiddleware(async (to, from) => {

  const userStore = useUserStore();

  // user registrado (loggeado)
  if (!!userStore.user && to.path !== '/auth/profile') {
    return await navigateTo('auth/profile');
  }


});

