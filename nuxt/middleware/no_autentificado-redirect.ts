export default defineNuxtRouteMiddleware(async (to, from) => {
  const usuarioStore = useUsuarioStore();

  // User not logged in
  if (!usuarioStore.user) {
    return await navigateTo('/AUTH/login/');
  }
});
