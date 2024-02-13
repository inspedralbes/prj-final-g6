<template>
    <div>
        <div class="container py-5 justify-content-center">
            <div>
                <h1>Profile</h1>
                <button class="px-3 py-2 rounder-md bg-blue-500 text-white justify-center">
                    Sign Out
                </button>
            </div>

            <pre>{{ userStore.user }}</pre>
        </div>
    </div>
</template>

<script lang="ts" setup>


const userStore = useUserStore()

definePageMeta({
    middleware: ['already-auth'],
})
</script>

<style></style>