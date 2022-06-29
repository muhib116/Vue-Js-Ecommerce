import { createRouter, createWebHistory } from "vue-router";

// pages import start
import Home from './pages/Home.vue'
import PageNotFound from './pages/PageNotFound.vue'
import CategoryWiseProducts from './pages/CategoryWiseProducts.vue'
import AllCategories from './pages/AllCategories.vue'
import AllShops from './pages/AllShops.vue'
import Offers from './pages/Offers.vue'
// pages import end

const routers = [
    {
        path: '',
        name: 'Home',
        component: Home
    },
    {
        path: '/category/:slug',
        name: 'CategoryWiseProducts',
        component: CategoryWiseProducts
    },
    {
        path: '/categories',
        name: 'AllCategories',
        component: AllCategories
    },
    {
        path: '/all-shops',
        name: 'AllShops',
        component: AllShops
    },
    {
        path: '/offers',
        name: 'Offers',
        component: Offers
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