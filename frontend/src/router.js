import DefaultLayout from "./components/DefaultLayout.vue";
import Home from "./components/Pages/Delivery/Home.vue";
import Cart from "./components/Pages/Delivery/Cart.vue";
import Login from "./components/Pages/Dashboards/Login.vue";
import Register from "./components/Pages/Dashboards/Register.vue";
import DashboardAdmin from "./components/Pages/Dashboards/DashboardAdmin.vue";
import Orders from "./components/Pages/Dashboards/Orders.vue";
import Deliveries from "./components/Pages/Dashboards/Deliveries.vue";
import Ingredients from "./components/Pages/Dashboards/Ingredients.vue";
import Sizes from "./components/Pages/Dashboards/Sizes.vue";
import {createRouter, createWebHistory} from "vue-router";

const routes = [ {
    // delivery routes
    path: '/',
    component: DefaultLayout,
    children: [
        { path: '/', name: 'Home', component: Home },
        { path: '/cart', name: 'Cart', component: Cart },
        ]
    },
    {
        path: '/dashboard',
        component: DashboardAdmin,
        name: 'Dashboard'
    },
    {
        path: '/register',
        component: Register,
        name: 'Register'
    },
    {
        path: '/login',
        component: Login,
        name: 'Login'
    },
    {
        path: '/orders',
        component: Orders,
        name: 'Orders'
    },
    {
        path: '/deliveries',
        component: Deliveries,
        name: 'Deliveries'
    },
    {
      path: '/ingredients',
      component: Ingredients,
      name: 'Ingredients'
    },
    {
      path: '/sizes',
      component: Sizes,
      name: 'Sizes'
    },
    {
        path: '/:catchAll(.*)*',
        redirect: '/'
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

export default router