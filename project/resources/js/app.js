require('./bootstrap');

// window.Vue = require('vue');
import Vue from "vue";
import VueRouter from "vue-router";

import ExampleComponent from "./components/ExampleComponent";
import ImageUpload from "./components/ImageUpload";

Vue.use(VueRouter);

const routes = [
    { path: '/', component: ExampleComponent },
    { path: '/er', component: ImageUpload }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router
}).$mount('#app');
