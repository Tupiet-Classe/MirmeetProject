<template>
    <div class="chat-user flex justify-between" @click="startChat(user.id)">
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
    }

    .last-message {
        color: #222222;
    }
</style>