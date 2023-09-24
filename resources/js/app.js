import './bootstrap';

import {createApp} from 'vue';
import * as VueRouter from 'vue-router'

import ShowTasksComponent from './components/ShowTasksComponent.vue'

const routes = [
    {path: '/', component:ShowTasksComponent },
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory('todoList/public'),
    routes,
    linkActiveClass: 'active',
    linkExactActiveClass: 'exact-active'
});

const app = createApp({});

window.url = '/todoList/public'

app.use(router)

app.component('show-tasks', ShowTasksComponent)

app.mount('#app')