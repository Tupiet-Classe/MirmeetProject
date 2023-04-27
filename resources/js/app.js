// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import titleComp from '../vue/welcome.vue'
import Perfil from '../vue/Perfil.vue';
import MyProfile from '../vue/MyProfile.vue';
import ChatRecentUsers from '../vue/ChatRecentUsers.vue';
import Chat from '../vue/Chat.vue';
import ChatUser from '../vue/ChatUser.vue';
import DiscoverWall from '../vue/DiscoverWall.vue';
import discover2 from '../vue/Discover2.vue';
import prova from '../vue/api.vue';

// Vue.component('discover2', require('./components/Discover2.vue').default)
import PostBtn1 from '../vue/Post1.vue';
import PostBtn2 from '../vue/Post2.vue';
import chartAdmin from '../vue/chartDashboard.vue';
import NotificationsBTN from '../vue/NotificationsBTN.vue';
import SearchBTN from '../vue/SearchBTN.vue';
import MyButton from '../vue/follow.vue';

const app = createApp({})
// app.component('discover2', require('./components/Discover2.vue').default)
app.component('discover2', discover2)

app.component('my-button', MyButton)

app.component('welcome', titleComp)

app.component('perfil', Perfil)
app.component('my-profile', MyProfile)
app.component('prova-api', prova)

app.component('chart', chartAdmin);
app.component('chat', Chat)
app.component('chat-user', ChatUser)
app.component('chat-recent-users', ChatRecentUsers)
app.mount('#app')

createApp(PostBtn1).mount('#post1')
createApp(NotificationsBTN).mount('#notify')
createApp(SearchBTN).mount('#search')
createApp(chartAdmin).mount('#graphic')
createApp(PostBtn2).mount('#post2')


// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
