<template>
    <div>
        <router-link to="/Crear-Review" class="btn-create-review">Crear Reseña</router-link>
    </div>
</template>

<script>


export default {
    props: {
        id_local: {
            type: Number,
            required: true
        }
    },
    mounted() {
        this.$store.commit('setIdLocal', this.id_local)
    }
}

</script>
<style lang="scss" scoped>
.btn-create-review {
    background-color: var(--verde);
    display: flex;
    border-radius: 8px;
    color: var(--blanco);
    font-size: 1.5rem;
    padding: 1rem 2rem;
    text-align: center;
    width: 100%;
    justify-content: center;
    text-decoration: none;
    margin-top: 40px;

}
</style>