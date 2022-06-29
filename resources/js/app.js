
require('./bootstrap');

import {createApp} from 'vue'

import router from './route.js'
import store from './store.js'

import Master from './pages/Master.vue'

let Vue = createApp(Master);
Vue.use(router)
Vue.use(store)
Vue.mount('#app');