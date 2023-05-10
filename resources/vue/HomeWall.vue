<!-- Codi de la pagina -->
<template>
    <div class="posts w-full sm:w-96 flex flex-col items-center gap-3 overflow-y-scroll">
        <div v-for="post in posts_data" :key="post.id_user"
            class="post flex flex-col gap-y-3 items-center bg-white rounded-md p-4">
            <div class="info bg-cyan w-full mx-5 p-3 rounded-lg flex flex-row gap-y-3">
                <div
                    class="flex flex-col rounded-full w-20 h-20 bg-gray-300 justify-center items-center mr-4 overflow-hidden">
                    <img v-bind:src="post.photo" alt="" class="w-full h-full object-cover">
                </div>
                <div class="other-content w-full flex justify-between">
                    <div class="user-info flex flex-col h-full justify-around ml-4 gap-y-1">
                        <span class="username text-sm font-comfortaa font-semibold">@{{ post.user }}</span>
                        <button class="btn-follow bg-purple rounded-xl py-0.5 px-4 text-white">Seguir</button>
                    </div>

                    <div class="extra-info flex gap-x-3 items-baseline">
                        <span class="time text-sm">{{ post.date.substring(0, 10) }}</span>
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

<!-- Opciones del post -->
<div class="options bg-purple w-full flex justify-around mx-5 p-1 rounded-lg text-white text-xl">
    <like-BTN v-bind:id_user="post.id_user" v-bind:id_post="post.post" />
    <button @click="toggleCommentInputForPost(post.post)">
        <i class="fa-regular fa-comment"></i>
    </button>
    <button>
        <i class="fa fa-retweet"></i>
    </button>
    <button>
        <i class="fa fa-share"></i>
    </button>
</div>
<div v-if="showCommentInput[post.post]" class="comment-input">
    <div v-for="comment in post.comments" :key="comment.id" class="comment">
        <p>{{ comment.text }}</p>
    </div>
    <!-- Código para agregar un comentario -->
    <textarea v-model="newComments[post.post]" class="w-full resize-none focus:outline-none p-2 rounded-lg"
        placeholder="Afegeix un comentari..."></textarea>
    <button @click="submitComment(post.post, post.id_user)"
        class="bg-purple rounded-xl py-0.5 px-4 text-white mt-2">Enviar</button>
</div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import likeBTN from './LikeBTN.vue'
import { resultPosts } from './mostrar-posts';

export default {
    components:{
        likeBTN
    },
    data() {
        return {
            posts_data: [],
            newComments: {},
            showCommentInput: {},
        }
    },
    mounted() {
        this.getposts()
    },
    methods: {
        getposts() {
            resultPosts('/posts-home').then(data => {
                this.posts_data = data;
            });
        },
        async getCommentsForPost(postId) {
            try {
                const response = await axios.get(`/discover/${postId}/comments`);
                return response.data.comments;
            } catch (error) {
                console.log(error);
                return [];
            }
        },
        toggleCommentInputForPost(postId) {
            this.showCommentInput[postId] = !this.showCommentInput[postId];
        },
        async submitComment(postId, userId) {
            try {
                const response = await axios.post(`/discover/${postId}/comments`, { text: this.newComments[postId] });
                // Limpiar el campo de comentario y ocultar el formulario
                this.newComments[postId] = '';
                this.showCommentInput[postId] = false;
                // Actualizar la lista de comentarios para la publicación
                const index = this.posts_data.findIndex(post => post.id_user === userId); 
                if (index >= 0) {
                    if (response.data.comment) {  // Agregamos esta línea para asegurarnos de que existe el comentario en la respuesta
                        this.posts_data[index].comments.push(response.data.comment);
                    }
                    // Actualizar la lista de comentarios
                    this.posts_data[index].comments = await this.getCommentsForPost(postId);
                }
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
