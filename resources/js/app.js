// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
// import titleComp from './src/welcome.vue'

import Perfil from '../vue/Perfil.vue';

import MyProfile from '../vue/MyProfile.vue';
import Chat from '../vue/Chat.vue';

const app = createApp({})

app.component('perfil', Perfil)
app.component('my-profile', MyProfile)
app.component('chat', Chat)
app.mount('#app')

// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
