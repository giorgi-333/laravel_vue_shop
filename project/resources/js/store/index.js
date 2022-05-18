import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        lang: "ka"
    },
    mutations: {
        changeLang (state) {
            state.lang = state.lang === "ka" ? "en" : "ka"
        }
    }
})

export default store
