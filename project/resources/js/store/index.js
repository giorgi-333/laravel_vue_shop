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
            if(!localStorage.user) {
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
        },
        login({commit,dispatch},data) {
            axios.post('/api/login',data)
                .then((res) => {
                    localStorage.user = res.data.token_type + ' ' + res.data.access_token
                    dispatch('checkLogin')
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
