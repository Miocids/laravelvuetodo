import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Toast, { POSITION } from "vue-toastification";
import "vue-toastification/dist/index.css";
import store from './store';
import Form from './components/Tasks/Form.vue';
import Notes from './components/Tasks/Notes.vue';
import Login from './components/Auth/Login.vue';
import Register from './components/Auth/Register.vue';
import NavComponent from './components/Nav/NavComponent.vue';

const routes = [
    {
        path: '/create-note',
        component: Form,
        meta: { requiresAuth: true },
    },
    {
        path: '/notes',
        component: Notes,
        meta: { requiresAuth: true },
    },
    { 
        path: '/login', 
        component: Login 
    },
    { 
        path: '/register', 
        component: Register 
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = store.getters.isAuthenticated;
    if (to.path === '/') {
        next('/login');
    }
    else if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        next('/login');
    }
    else if (!routes.some(route => route.path === to.path)) {
        next('/login');
    }
    else if(isAuthenticated && (to.path === '/login' || to.path === '/register')) {
        next('/notes');
    }
    else {
        next();
    }
});

const app = createApp({});
app.use(store);
app.use(Toast, {
    position: POSITION.TOP_RIGHT,
    timeout: 3000,
});
app.use(router);

//Components
app.component('nav-component',NavComponent);

app.mount('#app');
