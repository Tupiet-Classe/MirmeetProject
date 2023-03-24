<template>
    <div class="chat flex" style="height: calc(100vh - 4rem);">
        <div>
            <button @click="startChat(1)">Start chat with 1</button>
            <button @click="startChat(2)">Start chat with 2</button>
        </div>

        <div class="flex flex-col justify-between">
            <div class="content flex flex-col gap-3" id="messages">
            </div>
        
            <div class="message-bar h-fit">
                <input id="message" type="text" style="width: 100%">
                <button @click="send()">Send!</button>
            </div>
        </div>
    
    </div>
</template>

<script>
    import axios from 'axios'
    import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws'],
});
export default {
    data() {
        return {
            actualToken: '',
            username: ''
        }
    },
    mounted() {
        
        let id = (id) => document.getElementById(id)

        document.addEventListener('DOMContentLoaded', async (event) => {
            let messages = id('messages')

            let req = await axios.get('/me')
            let userId = req.data.id
            this.username = req.data.username
            console.log(userId, this.username)
            
            window.Echo.join('chat.' + userId)
                .here((users) => {
                    console.log('aquests usuaris estan al chat ' + userId, users)
                })
                .listen('StartChat', (res) => {
                    console.log('Invitat a un nou xat', res)

                    window.Echo.join('chat-between.' + res.token)
                        .here((users) => {
                            console.log(`Acabo d'entrar a la sala ${res.token}`)
                            console.log(users)
                            this.actualToken = res.token
                        })
                        .listen('NewMessage', (message) => {
                            console.log('Missatge rebut!', message)
                            this.showMessage(message)
                        })
                })
        })

        

    },
    methods: {
        showMessage(e) {
            let messages = document.getElementById('messages')
            let div = document.createElement('div')
            div.classList.add('comment');
            (e.username === this.username) 
                ? div.classList.add('my-comment')
                : div.classList.add('other-comment')
            let p = document.createElement('p')
            let message = document.createTextNode(e.username + ': ' + e.message)
            p.appendChild(message)
            div.appendChild(p)
            messages.appendChild(div)
            console.log(e);
        },
        send() {
            axios.post('/send', {
                message: document.getElementById('message').value,
                token: this.actualToken
            })
        },
        async startChat(id) {
            let res = await axios.get('/start-chat/' + id)
            let token = res.data.token
            this.actualToken = token
            console.log(token)
            window.Echo.join('chat-between.' + token)
                .here((users) => {
                    console.log(users)
                })
                .listen('NewMessage', (message) => {
                    this.showMessage(message)
                })
        }       
    }
}
</script>

<style>
    .comment{
        width: fit-content;
        background: white;
        padding: .5rem;
        border-radius: .5rem;
    }

    .my-comment {
        margin-right: auto;
    }

    .other-comment {
        margin-left: auto;
    }
</style>