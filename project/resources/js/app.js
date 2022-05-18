require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import vuetify from './plugins/vuetify'
import 'vuetify/dist/vuetify.min.css'
import store from './store/index'

Vue.use(VueRouter);


const router = new VueRouter({
    mode: 'history',
    routes
})

const app = new Vue({
    router,
    vuetify,
    store
}).$mount('#app');
