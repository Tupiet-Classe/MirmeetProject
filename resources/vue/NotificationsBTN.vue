<!-- Codi de la pagina -->
<template>
    <div>
        <button class="dropdown-toggle" type="button" data-toggle="dropdown">
            <i class="fa fa-bell text-2xl"></i>
            <span class="badge">{{ notifications.length }}</span>
        </button>
        <ul class="dropdown-menu">
            <li v-for="notification in notifications" :key="notification.id">
                {{ notification.user_id }}
            </li>
        </ul>
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
