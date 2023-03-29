// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
// import titleComp from './src/welcome.vue'

import Perfil from '../vue/Perfil.vue';
import MyProfile from '../vue/MyProfile.vue';
import Chat from '../vue/Chat.vue';
import DiscoverWall from '../vue/DiscoverWall.vue';
import discover2 from '../vue/Discover2.vue';

// Vue.component('discover2', require('./components/Discover2.vue').default)

const app = createApp({})
// app.component('discover2', require('./components/Discover2.vue').default)
app.component('discover2', discover2)
app.component('perfil', Perfil)
app.component('my-profile', MyProfile)
app.mount('#app')


// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
