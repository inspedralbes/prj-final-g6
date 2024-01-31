<template>
    <div>
        <button onclick="delete">Delete</button>
    </div>
</template>

<script>
export default {
    props: {
        discotecaId: {
            type: Number,
            required: true 
        }
    },
    methods: {
        async delete() {
            await strapi.entityService.delete('api::discoteca.discoteca', discotecaId);
        }
    }
}
</script>

<style lang="scss" scoped>

</style>