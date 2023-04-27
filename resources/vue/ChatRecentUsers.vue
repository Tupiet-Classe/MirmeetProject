<template>
    <div class="chat" style="height: calc(100vh - 4rem);">
        <div class="flex justify-between align-center w-full mt-2">
            <h1 class="text-2xl">Recent chats</h1>
            <button @click="openModal">New chat</button>
        </div>
        <div class="chat-users">
            <div v-for="user in users">
                <chat-user :user="user" />
            </div>
        </div>    
    </div>

    <Modal :isOpen="showModal" @update:isOpen="showModal = $event">

        <!-- Contenido del modal -->        
        <div>
            <h2 class="text-lg font-medium text-gray-900 mb-4">Chat</h2>
            <p v-if="followingUsersToChat.length === 0">To chat with someone, you must follow him/her.</p>
            <p v-else>Listado de usuarios</p>
            <div class="p-2 rounded-md bg-cyan-300">
                <chat-user v-for="user in followingUsersToChat" :user="user" />
            </div>
        </div>

        <!-- Botones del modal -->
        <div class="bg-gray-50 px-4 py-3 sm:px-6 w-full justify-between flex sm:flex sm:justify-center">
            <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                @click="closeModal()">
                Cancelar
            </button>
        </div>
    </Modal>
</template>

<script>
    import axios from 'axios'
    import Modal from './Modal.vue'
    
    export default {
        data() {
            return {
                users: [],
                followingUsersToChat: [],
                showModal: false
            }
        },
        components: {
            Modal
        },
        mounted() {
            document.addEventListener('DOMContentLoaded', async (event) => {
                await this.getRecentChats()
                await this.getFollowingUsersToChat()
            })
        },
        methods: {
            async getRecentChats() {
                let req = await axios.get('/recent-chats')
                this.users = req.data
                console.log(this.users)
            },
            async getFollowingUsersToChat() {
                let req = await axios.get('/following-users')
                this.followingUsersToChat = req.data
                console.log(this.followingUsersToChat)
            },
            closeModal() {
                this.showModal = false
            },
            openModal() {
                this.showModal = true
            }
        }
    }
</script>

<style scoped>
    /* .chat-user {
        background: white;
        width: 24rem;
        padding: .5rem;
        border-radius: .5rem;
        margin: .5rem;
        cursor: pointer;

        transition: background-color 200ms ease;
    }

    .chat-user:hover {
        background: var(--cyan);
    } */
</style>