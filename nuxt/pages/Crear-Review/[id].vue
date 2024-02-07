<template>
    <div>
        <p>EStoy haciendo la review de {{ $route.params.id }}</p>

    </div>
</template>


<script setup>
const route = useRoute()
console.log(route.params.id)
</script>

<style lang="scss" scoped></style>