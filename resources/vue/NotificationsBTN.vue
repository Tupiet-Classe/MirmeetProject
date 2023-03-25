<!-- Codi de la pagina -->
<template>
    <div>
        <button @click="isOpen = !isOpen" class="">
            <i class="fa fa-bell text-2xl"></i>
            <span class="badge">{{ notifications.length }}</span>
        </button>

        <div v-show="isOpen" class="absolute mt-2 w-48 bg-white rounded-md">
            <ul>
                <li class="cursor-pointer" v-for="notification in notifications" :key="notification.id">
                    <div
                        class="select-none flex flex-1 items-center p-1">
                        <div class="flex flex-col rounded-md w-10 h-10 bg-gray-300 justify-center items-center mr-4">
                            <img v-bind:src="notification.avatar" alt="">
                        </div>
                        <div class="flex-1 pl-1 mr-16 p-2">
                            <div class="text-gray-600 text-xs">{{ notification.share == '' && notification.like == '' ? 'es null' : 'Tienes un comentario'}}</div>
                            <div class="text-gray-600 font-bold text-xs">@{{ notification.username }}</div>
                        </div>
                        <div class="text-gray-600 text-xs p-1">2m</div>
                    </div>
                </li>
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
