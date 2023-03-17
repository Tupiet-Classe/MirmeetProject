<template>
    <h3>Welcome back <strong>{{ name }}</strong></h3>
    <br>
</template>
<script>
    export default {
        data() {
            return {
                name: `${window.user.name}!`
            }
        }
    }
</script>
<style scoped>
    /* h3{
        color: rgb(28, 239, 63);
    } */
</style>

