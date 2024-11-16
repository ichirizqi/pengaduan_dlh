import { createApp } from 'vue'
import App from './App.vue'
// window.Vue = require('vue');
// Vue.mixin(require('./public/admin'));

//import router

import router from './router'

import './assets/tailwind.css'



const app = createApp(App)

//use vue router
app.use(router)

app.mount('#app')