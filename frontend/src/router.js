import DefaultLayout from "./components/DefaultLayout.vue";
import Home from "./components/Pages/Delivery/Home.vue";
import Cart from "./components/Pages/Delivery/Cart.vue";
import Login from "./components/Pages/Dashboards/Login.vue";
import UserRegister from "./components/Pages/Dashboards/Admin/UserRegister.vue";
import Orders from "./components/Pages/Dashboards/Admin/Orders.vue";
import Deliveries from "./components/Pages/Dashboards/Admin/Deliveries.vue";
import Ingredients from "./components/Pages/Dashboards/Admin/Ingredients.vue";
import Sizes from "./components/Pages/Dashboards/Admin/Sizes.vue";
import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "./components/Pages/Dashboards/Admin/Dashboard.vue";

const routes = [
    {
        path: '/',
        component: DefaultLayout,
        children: [
            {path: '/', name: 'Home', component: Home},
            {path: '/cart', name: 'Cart', component: Cart},
        ]
    },
    {
        path: '/admin',
        component: DefaultLayout,
        children: [
            {path: '', name: 'Dashboard', component: Dashboard },
            {path: 'orders', name: 'Orders', component: Orders},
            {path: 'deliveries', name: 'Deliveries', component: Deliveries},
            {path: 'ingredients', name: 'Ingredients', component: Ingredients},
            {path: 'sizes', name: 'Sizes', component: Sizes},
            {path: 'register', name: 'UserRegister', component: UserRegister},
        ]
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        // deals with non set routes
        path: '/:catchAll(.*)*',
        redirect: '/'
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router