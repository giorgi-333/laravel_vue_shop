require('./bootstrap');

// window.Vue = require('vue');
import Vue from "vue";
import VueRouter from "vue-router";

// import pages
import Website from "./pages/Website";
import Todo from "./components/todo";
import ImageUpload from "./components/ImageUpload";

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
