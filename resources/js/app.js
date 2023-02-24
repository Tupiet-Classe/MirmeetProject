// VUE
import { createApp } from 'vue/dist/vue.esm-bundler.js'
import titleComp from '../src/welcome.vue'

const app = createApp({})

app.component('titulo', titleComp)

if (window.location.pathname === '/dashboard') {
    app.mount('#welcome')
}

// BREEZE
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
