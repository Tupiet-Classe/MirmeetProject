<template>
    <div class="chat" style="height: calc(100vh - 4rem);">
        <h1 class="text-2xl">Recent chats</h1>
        <div class="chat-users">
            <div class="chat-user" v-for="user in users">
                <chat-user :user="user" />
            </div>
        </div>    
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                users: []
            }
        },
        mounted() {
            
            let id = (id) => document.getElementById(id)

            document.addEventListener('DOMContentLoaded', async (event) => {
                await this.getRecentChats()
            })
        },
        methods: {
            async getRecentChats() {
                let req = await axios.get('/recent-chats')
                this.users = req.data
                console.log(users)
            }
        }
    }
</script>

<style>

</style>