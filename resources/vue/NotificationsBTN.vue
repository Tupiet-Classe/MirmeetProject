<!-- Codi de la pagina -->
<template>
    <div>
        <button @click="isOpen = !isOpen"
            class="">
            <i class="fa fa-bell text-2xl"></i>
            <span class="badge">{{ notifications.length }}</span>
        </button>

        <div v-show="isOpen" class="absolute mt-2 w-20 bg-white rounded-md">
            <ul>
                <li v-for="notification in notifications" :key="notification.id"
                    class="py-2 px-3 hover:bg-gray-100 cursor-pointer">{{ notification.user_id }}</li>
            </ul>
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
        // this.getPostsData()
        // this.getPosts()
    },
    data() {
        return {
            isOpen: false,
            notifications: [],
        }
    },
    methods: {
        getNotifications() {
            axios.get('get-notifications').then(res => {
                this.notifications = res.data;
            });
        },
    }
}
</script>
