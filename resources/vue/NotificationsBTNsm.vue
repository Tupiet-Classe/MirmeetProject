<!-- Codi de la pagina -->
<template>
    <div>
        <button @click="isOpen = !isOpen" class="">
            <i class="fa fa-bell text-2xl"></i>
            <span class="badge">{{ notifications.length }}</span>
        </button>

        <div v-show="isOpen" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 z-10">
            <div class="mt-2 w-48 bg-white rounded-md">
                <div class="flex justify-center items-center mt-2">
                    <button @click="isOpen = !isOpen" class="mr-3">
                        <i class="fa-solid fa-x"></i>
                    </button>
                    <button @click="quitNotifications" class="ml-3">
                        <i class="fa-solid fa-bell-slash"></i>
                    </button>
                </div>
                <ul>
                    <li class="cursor-pointer" v-for="(notification, index) in notifications" :key="notification.id">
                        <div class="select-none flex flex-1 items-center p-1">
                            <div v-if="posts && posts.length > 0"
                                class="flex flex-col rounded-full w-10 h-10 bg-gray-300 justify-center items-center mr-4 overflow-hidden">
                                <img v-bind:src="posts[0].image" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 pl-1 mr-16 p-2">
                                <div class="text-gray-600 text-xs">{{ notification.follow != null ? 'Te acaba de seguir' :
                                    '' }}</div>
                                <div class="text-gray-600 text-xs">{{ notification.share != null ? 'Tienes un repost' : ''
                                }}</div>
                                <div class="text-gray-600 text-xs">{{ notification.like != null ? 'Tienes un like' : '' }}
                                </div>
                                <div class="text-gray-600 text-xs">{{ notification.message != null ? 'Tienes un comentario'
                                    : '' }}</div>
                                <div>
                                    <div v-if="username && username.length > 0">
                                        <div class="text-gray-600 font-bold text-xs">@{{ username[index %
                                            username.length].username }}</div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="text-gray-600 text-xs p-1">{{ notifications.date == null ? '' :
                                notification.date.substring(10, 16) }}</div> -->
                        </div>
                    </li>
                </ul>
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
        this.getNotifications()
    },
    data() {
        return {
            isOpen: false,
            notifications: [],
            username: [],
            posts: []
        }
    },
    methods: {
        getNotifications() {
            axios.get('get-notifications').then(res => {
                this.notifications = res.data.data;
                this.username = res.data.username;
                const posts = res.data.posts;
                for (let i = 0; i < posts.length; i++) {

                    const post = posts[i];

                    const postJSON = {
                    };

                    let js = JSON.parse(post.data)
                    postJSON.image = js.image,
                        postJSON.text = js.text
                    this.posts.push(postJSON)
                }
            });
        },
        quitNotifications() {
            axios.get('/quit-notifications').then(res => {
                this.notifications = [];
                this.username = [];
                this.posts = [];
                this.isOpen = false;
            });
        },
    }
}
</script>
