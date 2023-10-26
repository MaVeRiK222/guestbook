/* Работай */

import './bootstrap';
import {createApp} from 'vue';
import {createRouter, createWebHistory} from 'vue-router';
import store from './store.js'

import Comments from './components/comments/Comments.vue';
import App from './App.vue'
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import EditComment from './components/comments/EditComment.vue'
const routes = [
    {
        
        path:'/comments',
        name: 'Comments',
        component: Comments
    },
    {
        
        path:'/comments/:commentId',
        name: 'EditComment',
        component: EditComment,
        props: true
    },
    {
        path:'/register',
        name: 'Register',
        component: Register
    },
    {
        path:'/login',
        name: 'Login',
        component: Login
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})
const app = createApp(App);
app.use(router);
app.use(store);
app.mount("#app");