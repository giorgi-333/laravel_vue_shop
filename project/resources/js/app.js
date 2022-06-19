require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";
import routes from "./routes";
import vuetify from './plugins/vuetify'
import 'vuetify/dist/vuetify.min.css'
import store from './store/index'
import axios from 'axios'
import i18n from "./plugins/translate";

// export const bus = new Vue();


// axios
let request = axios.create({
    // timeout: 2000,
    headers: { 'Accept-Language': store.state.lang }
});
export { request };

// router
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes
})

// new vue
const app = new Vue({
    router,
    vuetify,
    store,
    i18n
}).$mount('#app');
