<template>
    <div class="chat-user flex flex-row justify-between bg-white p-2 rounded-md cursor-pointer w-full" @click="startChat(user.id)">
        <span class="username">{{ user.username }}</span>
        <span v-if="user.last_message" class="last-message">{{ user.last_message }}</span>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        methods: {
            startChat(id) {
                console.log('id', id)
                location.href = '/chat/'+ id
            }
        }
    }
</script>


<style scoped>
    .chat-user {
        min-width: 3rem;
        max-width: 20rem;
        transition: background-color 200ms ease;
    }

    .chat-user > * {
        width: fit-content;
        text-align: center;
    }

    .chat-user:hover {
        background: var(--cyan);
    }

    .last-message {
        color: #222222;
    }
</style>