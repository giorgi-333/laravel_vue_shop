import VueI18n from 'vue-i18n'
import Vue from "vue";
import store from "../store";

Vue.use(VueI18n);

const translate = {
    en: {
        home: 'Home'
    },
    ka: {
        home: 'მთავარი'
    }
}
const i18n = new VueI18n({
    locale: store.state.lang,
    messages: translate,
})

export default i18n
