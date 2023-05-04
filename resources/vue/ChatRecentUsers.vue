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
                <label class="relative block">
                    <span class="sr-only">Search</span>
                    <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20"></svg>
                    </span>
                    <input id="search-users" @keyup="getSearchedFollowingUsersToChat()" class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search for anything..." type="text" name="search"/>
                </label>

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
            async getSearchedFollowingUsersToChat() {
                let searched = document.getElementById('search-users').value
                let req = await axios.get('/following-users/' + searched)
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