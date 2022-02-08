require('./bootstrap');

// window.Vue = require('vue');
import Vue from "vue";
import VueRouter from "vue-router";

// import pages
import Website from "./pages/Website";
import Todo from "./pages/Todo";
import ImageUpload from "./pages/ImageUpload";
import Meet from "./pages/Meet";
import MeetMain from "./pages/MeetMain";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        component: Website,
        children: [
            {
                path: 'todo',
                name: 'todo',
                component: Todo
            },
            {
                path: 'image-upload',
                name: 'imageUpload',
                component: ImageUpload
            },
            {
                path: 'meet',
                name: 'meet',
                component: Meet,
            },
            {
                path: 'meet-home',
                name: 'MeetMain',
                component: MeetMain
            }
        ]
    }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router
}).$mount('#app');
