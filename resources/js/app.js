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

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'

/* add icons to the library */
library.add(fas, fab, far)

const app = createApp({});

window.url = '/todoList/public'

app.use(router)

app.component('show-tasks', ShowTasksComponent)

app.component('fa', FontAwesomeIcon)


app.mount('#app')