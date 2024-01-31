<template>
    <div>
        <form action="">
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title">
            </div>
            <br>
            <br>

            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <br>
            <br>
            <div>
                <label for="date_of_pub">Date of Publication:</label>
                <input type="date" id="date_of_pub" name="date_of_pub">
            </div>
            <br>
            <br>
            <div>
                <label for="illustration">Illustration:</label>
                <input type="file" id="illustration" name="illustration">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>

</style>