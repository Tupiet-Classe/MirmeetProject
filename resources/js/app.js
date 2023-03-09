// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import titleComp from '../vue/welcome.vue'

import Perfil from '../vue/Perfil.vue';

import MyProfile from '../vue/MyProfile.vue';

import PostBtn1 from '../vue/NewPost.vue';

const app = createApp({})

app.component('welcome', titleComp)

app.component('perfil', Perfil)

app.component('add-post1', PostBtn1)

app.component('my-profile', PostBtn1)

app.mount('#app')
// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
