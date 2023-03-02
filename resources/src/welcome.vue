<template>
    <h3>Welcome back <strong>{{ name }}</strong></h3>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="justify-center">
                <!-- <img src="img/dashboard-first.png" alt="dashboard" width="100%" height="100%">
                <img src="img/dashboard-second.png" alt="dashboard" width="100%" height="100%"> -->
            </div>
        </div>
    </div>
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

