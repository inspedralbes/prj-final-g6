<template>
  <div class="container flex items-center justify-center">
   <div>
    <h1>welcome</h1>

    <p>Sign in to your profile</p>
    <button @click="signIn" class="px-3 py-2 rounder-md bg-blue-500 text-white justify-center">
        Sign In
    </button>
   </div>
  </div>
</template>

<script lang="ts" setup>
    const userStore = useUserStore()

    const signIn = async () => {
        await userStore.signIn({
            // should be taken from input fields 
            username: "kminchelle",
            password: "0lelplR",
        });

        await navigateTo("/auth/profile", { replace: true });

    }
</script>

<style>

</style>