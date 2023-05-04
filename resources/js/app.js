// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import titleComp from '../vue/welcome.vue'
import Perfil from '../vue/Perfil.vue';
import MyWall from '../vue/MyWall.vue';
import HomeWall from '../vue/HomeWall.vue';
import ChatRecentUsers from '../vue/ChatRecentUsers.vue';
import Chat from '../vue/Chat.vue';
import { i18nVue } from 'laravel-vue-i18n'; //Importacion de vue-i18n con Laravel integrado
import ChatUser from '../vue/ChatUser.vue';
import DiscoverWall from '../vue/DiscoverWall.vue';
import discover2 from '../vue/Discover2.vue';
import prova from '../vue/api.vue';

// Vue.component('discover2', require('./components/Discover2.vue').default)
import PostBtn1 from '../vue/Post1.vue';
import PostBtn2 from '../vue/Post2.vue';
import chartAdmin from '../vue/chartDashboard.vue';
import NotificationsBTN from '../vue/NotificationsBTN.vue';
import NotificationsBTNsm from '../vue/NotificationsBTNsm.vue';
import SearchBTN from '../vue/SearchBTN.vue';
import MyButton from '../vue/follow.vue';


const app = createApp({})
// app.component('discover2', require('./components/Discover2.vue').default)
app.component('discover-wall', DiscoverWall)

app.component('home-wall', HomeWall)

app.component('my-button', MyButton)

app.component('welcome', titleComp)

app.component('perfil', Perfil)
app.component('my-wall', MyWall)
app.component('prova-api', prova)

app.component('chart', chartAdmin);
app.component('chat', Chat)
app.component('chat-user', ChatUser)
app.component('chat-recent-users', ChatRecentUsers)
app.mount('#app')

createApp(PostBtn1).mount('#post1')
createApp(NotificationsBTN).mount('#notify')
createApp(NotificationsBTNsm).mount('#notify2')
createApp(SearchBTN).mount('#search')
createApp(chartAdmin).mount('#graphic')
createApp(PostBtn2).mount('#post2')


/**
  * Mateix manera de traduir que a Mirmeet 
  * Middleware que permet carregar automàticament els fitxers d'idioma de l'aplicació segons l'idioma seleccionat per l'usuari.
  *
  * * resolve és una funció asíncrona que rep com a paràmetre el codi de l'idioma que volem traduir
  * * la funcio import.meta.glob és una funció que retorna un objecte amb un mapeig de totes les rutes relatives que coincideixen amb el patró especificat
  *
  */
app.use(i18nVue, {
    resolve: async lang => {
        const langs = import.meta.glob('../lang/*.json');
        return await langs[`../lang/${lang}.json`]();
    }
});

// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
