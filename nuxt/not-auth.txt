export default defineNuxtRouteMiddleware(async(to, from) => {
    
    const userStore = useUserStore();
    
    // user no registrado (no loggeado)
    if(!userStore.user) {
        return await navigateTo('auth');
    }
       
   });