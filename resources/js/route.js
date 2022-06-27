import { createRouter, createWebHistory } from "vue-router";

// pages import start
import Home from './pages/Home.vue'
import PageNotFound from './pages/PageNotFound.vue'
import About from './pages/About.vue'
// pages import end

const routers = [
    {
        path: '/home',
        name: 'Home',
        component: Home
    },
    {
        path: '/about',
        name: 'About',
        component: About
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'PageNotFound',
        component: PageNotFound 
    }
    
];


const router = createRouter({
    history: createWebHistory(),
    routes: routers,
    scrollBehavior(to, from, savedPosition) {
        // always scroll to top
        return { 
            top: 0,
            behavior: 'instant'
        }
    },
});

export default router