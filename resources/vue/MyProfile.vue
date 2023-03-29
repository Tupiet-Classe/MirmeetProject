<!-- Codi de la pagina -->
<template>
    <div class="posts w-full sm:w-96 flex flex-col items-center gap-3 overflow-y-scroll">
        <div v-for="post in posts_data" :key="post.id"
            class="post flex flex-col gap-y-3 items-center bg-white rounded-md p-4">
            <div class="info bg-cyan w-full mx-5 p-3 rounded-lg flex flex-row gap-y-3">
                <div class="user-image w-16" src=""> 
                    <img alt="user">
                </div>
                <div class="other-content w-full flex justify-between">
                    <div class="user-info flex flex-col h-full justify-around ml-4 gap-y-1">
                        <span class="username text-sm font-comfortaa font-semibold">@{{ post.user }}</span>
                        <button class="btn-follow bg-purple rounded-xl py-0.5 px-4 text-white">Seguir</button>
                    </div>

                    <div class="extra-info flex gap-x-3 items-baseline">
                        <span class="time text-sm"></span>
                        <i class="fa-solid fa-ellipsis-vertical text-purple cursor-pointer"></i>
                    </div>
                </div>
            </div>

            <div class="images w-full mx-5 mt-1">
                <div class="image w-full">
                    <img :src="post.image" alt="image" class="rounded-md">
                </div>
            </div>



            <div class="content bg-cyan w-full mx-5 p-3 rounded-lg flex flex-col text-sm relative">
                <p>{{ post.text }}</p>
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
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            posts_data: [],
        }
    },

    mounted() {
        axios.get('/posts-home')
            .then(response => {
                const posts = response.data;
                for (let i = 0; i < posts.length; i++) {

                    const post = posts[i];

                    const postJSON = {
                        user: post.user,
                    };

                    let js = JSON.parse(post.data)
                    postJSON.image = js.image,
                        postJSON.text = js.text,
                        console.log(postJSON);
                    this.posts_data.push(postJSON)
                }
            })
            .catch(error => {
            });
    },



    methods: {

    },

}

</script>

