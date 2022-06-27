
require('./bootstrap');

import {createApp} from 'vue'
import router from './route.js'
// import router from './router'
// import VueRouter from 'vue-router';
// import * as VueRouter from 'vue-router';


import Header from './components/global/Header.vue'
import Master from './pages/Master.vue'


let Vue = createApp(Master);
Vue.use(router)
Vue.mount('#app');