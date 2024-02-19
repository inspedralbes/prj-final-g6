import { defineStore } from 'pinia';
import { ref } from 'vue';
import type { get__usuario } from '~/types';


export const useUsuarioStore = defineStore("usuario", () => {
    const user = ref();
    const token = useCookie('MY__COOKIE', {
        maxAge: 60 * 60, // 1 hour
    });

    const setToken = (data?: any) => { token.value = data };
    const setUser = (data?: any) => { user.value = data };

    const login = async (data: any) => {
        try {
      
            const response = await fetch("http://localhost:8000/api/login", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    
                },
                body: JSON.stringify(data),
            });

            const res = await response.json();
           
            setToken(res.token);

            await fetchUser();
        } catch (error) {
            setUser();
            setToken();
            console.error(error);
        }
    };

    const fetchUser = async () => {
        if (token.value) {
            try {
      
                const response = await $fetch<get__usuario>("http://localhost:8000/api/user", {
                    method: "GET",
                }); 

                setUser(response);
            } catch (error) {
                setUser();
                console.error(error);
            }
        }
    };

    const register = async (data: any) => {
        try {
 
            const res = await $fetch<get__usuario>("http://localhost:8000/api/register", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(data),
            });
            setToken(res.token);
            await fetchUser();
        } catch (error) {
            setUser();
            setToken();
            console.error(error);
        }
    };

    const logout = () => {
        setUser();
        setToken();
    };

    return {
        user,
        token,
        login,
        register,
        fetchUser,
        logout,
        setToken,
        setUser
    };
});
