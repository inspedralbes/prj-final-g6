export default defineNuxtPlugin(async(nuxtApp) => {
    // para obtener el usuario al recargar la pagina o al iniciar la aplicacion
    const userStore = useUserStore();
    if(!userStore.user){
        await userStore.fetchCustomer()
    }

    const usuarioStore = useUsuarioStore();
    if(!usuarioStore.user){
        await usuarioStore.fetchUser()
    }
})