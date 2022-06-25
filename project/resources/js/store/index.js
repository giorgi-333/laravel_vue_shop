import Vuex from "vuex";
import Vue from "vue";
//modules
import frontAuth from "./frontAuth";
import adminAuth from "./adminAuth";

Vue.use(Vuex)


const store = new Vuex.Store({
    modules: {
        front: frontAuth,
        admin: adminAuth
    },
    state: {
        lang: "ka"
    },
    mutations: {
        changeLang(state, lang) {
            state.lang = lang
        }
    }
})

export default store
