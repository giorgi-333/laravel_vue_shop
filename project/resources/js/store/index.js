import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        lang: "ka",
        isLogged: false
    },
    actions: {
        checkLogin({commit}) {
            // const varToken = 'Bearer 1|KLuevVYsoOV6KLQPRoabUW7ApcFlGJs9eBEitLFg' // admin full
            if(!localStorage.user) {
                console.log("not logged")
                return
            }
            return axios.post('/api/me', {},
                {
                    headers: {
                        Authorization: localStorage.user
                    }
                }).then((res) => {
                commit('setLogin')
            }).catch((res) => {
                console.log(res)
            })
        }
    },
    mutations: {
        changeLang(state, lang) {
            state.lang = lang
        },
        setLogin(state) {
            state.isLogged = true
        }
    }
})

export default store
