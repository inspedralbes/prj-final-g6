<template>
    <div>
        <button onclick="delete">Delete</button>
    </div>
</template>

<script>
export default {
    props: {
        llibreId: {
            type: Number,
            required: true 
        }
    },
    methods: {
        async delete() {
            await strapi.entityService.delete('api::libro.libro', llibreId);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>