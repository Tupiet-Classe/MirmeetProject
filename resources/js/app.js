// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import titleComp from '../vue/welcome.vue'
import Perfil from '../vue/Perfil.vue';
import MyProfile from '../vue/MyProfile.vue';
import PostBtn1 from '../vue/Post1.vue';
import PostBtn2 from '../vue/Post2.vue';
import chartAdmin from '../vue/chartDashboard.vue';

import MyButton from '../vue/follow.vue';

const app = createApp({})

app.component('my-button', MyButton)

app.component('welcome', titleComp)

app.component('perfil', Perfil)

app.component('my-profile', MyProfile)

app.component('chart', chartAdmin);

app.mount('#app')

createApp(PostBtn1).mount('#post1')

createApp(chartAdmin).mount('#graphic')
// createApp(PostBtn2).mount('#post2')
// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
