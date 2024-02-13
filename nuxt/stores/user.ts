import { defineStore } from 'pinia'
import { ref } from 'vue'
import type { User } from "../types";
import type { Customer } from "../types";

export const useUserStore = defineStore("user", () => {
    const user = ref();
    const token = useCookie('MY__COOKIE', {
        maxAge: 60 * 60, // 1 hora
      

    });
  
    const setToken = (data?: any) => { token.value = data };
    const setUser = (data?: any) => { user.value = data };

    const signIn = async (data: any) => {
        try {
            const res = await $fetch<User>("https://dummyjson.com/auth/login", {
                method: "POST",
                body: data,
            });
            setToken(res.token);
            // funcion para obterner el usuario que se acaba de registrar
            await(fetchCustomer());

        } catch (error) {
            setUser();
            setToken();
            console.log(error);
        }
    };
    const fetchCustomer = async () => {
        if(token.value){
            try{
                const res = await $fetch<Customer>("https://dummyjson.com/user/1");
                setUser(res);
            }catch{
                setUser();
                console.log(Error);
            }
        }
    };
    const logout = () => {
        setUser();
        setToken();
    };
    return {

        user,
        token,
        signIn,
        fetchCustomer,
        logout,
        setToken,
        setUser
    };

});