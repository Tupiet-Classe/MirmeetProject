<!-- Codi de la pagina -->
<template>
    <div class="pt-5 posts w-full sm:w-96 flex flex-col items-center gap-3 overflow-y-scroll">
        <div class="posts w-full sm:w-96 flex flex-col items-center gap-3 overflow-y-scroll">
            <div 
                v-for="post in posts_data" :key="post.id"
                class="post flex flex-col gap-y-3 items-center bg-white rounded-md p-4">

                <div class="info bg-cyan w-full mx-5 p-3 rounded-lg flex flex-row gap-y-3">
                    <div class="user-image w-16">
                        <img v-bind:src="users.avatar" alt="logo">
                    </div>
                    <div class="other-content w-full flex justify-between">
                        <div class="user-info flex flex-col h-full justify-around ml-4 gap-y-1">
                            <span class="username text-sm font-comfortaa font-semibold">@{{users.username}}</span>
                            <button class="btn-follow bg-purple rounded-xl py-0.5 px-4 text-white">Seguir</button>
                        </div>

                        <div class="extra-info flex gap-x-3 items-baseline">
                            <span class="time text-sm">Hace 3 días</span>
                            <i class="fa-solid fa-ellipsis-vertical text-purple cursor-pointer"></i>
                        </div>
                    </div>
                </div>

                <div class="images w-full mx-5 mt-1">
                    <div class="image w-full">
                        <img v-bind:src="post.image" alt="image" class="rounded-md">
                    </div>
                </div>

                <div class="content bg-cyan w-full mx-5 p-3 rounded-lg flex flex-col text-sm relative">
                    <p>{{ post.comment }}</p>
                    <div class="topics mt-2 flex flex-wrap gap-2">
                        <span class="topic bg-red py-1 px-2 rounded-xl text-white w-fit">
                            #hello-world
                        </span>
                        <span class="topic bg-red py-1 px-2 rounded-xl text-white w-fit">
                            #test
                        </span>

                    </div>
                </div>

                <div class="options bg-purple w-full flex justify-around mx-5 p-1 rounded-lg text-white text-xl">
                    <button><i class="fa-regular fa-heart"></i></button>
                    <button><i class="fa fa-retweet"></i></button>
                    <button><i class="fa-regular fa-comment"></i></button>
                    <button><i class="fa fa-share"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- Scripts per a esta vista -->
<script>
import axios from 'axios';
import swal from 'sweetalert';

export default {
    mounted() {
        this.getPostsData()
        this.getPosts()
    },
    data() {
        return {
            posts_data: [],
        }
    },
    methods: {
        getPostsData() {
            axios.get('posts-discover').then(res => {
                this.posts_data = res.data;
            });
        },
    }
}
</script>

<!-- Estils per a esta vista -->
<style scoped>
</style>
