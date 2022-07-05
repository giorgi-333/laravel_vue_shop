<template lang="pug">
    v-app-bar(elevation="4" fixed)
        v-spacer
        v-tabs(align-with-title)
            v-tab(:to="{name: 'home'}" exact) {{ $t("home") }}
            v-tab(:to="{name: 'products'}" exact) {{ $t("products") }}
            v-tab(:to="{name: 'about'}" exact) {{ $t("about_us") }}
            //v-tab(:to="{name: 'admin'}" exact) admin
        v-switch(
            v-model="$vuetify.theme.dark"
            color="secondary"
            hide-details )

        v-select(
            v-model="activeLang"
            :items="langs"
            item-value="value"
            style="max-width: 152px"
            :menu-props="{dark: true}"
            @change="langChanged"
            hide-details="true"
            class="mr-4 ml-2"
        )
            template(v-slot:selection="{ item }")
                v-img(:src="langImage(item.value)" max-width="20px" max-height="15px" class="mr-1")
                span {{ item.text }}
            template(v-slot:item="{item}")
                v-img(:src="langImage(item.value)" max-width="20px" max-height="15px" class="mr-1")
                span {{ item.text}}
        // fab
        v-badge(
            color="green"
            :content="cartLength"
            class="mr-3"
            :value="cartLength"
        )
            v-btn(
                color="primary"
                small
                to="/cart"
            )
                v-icon(left) mdi-cart

        v-btn(
            tile
            color="primary"
            rounded
            @click="logOut"
            v-if="$store.state.front.isLogged"
        )
            v-icon(left) mdi-arrow-right-bold-box
            | {{ $t('logOut') }}
        template(v-else)
            v-btn.mr-2(
                tile
                color="primary"
                rounded
                @click="showLogin = true"
            )
                | {{ $t('login') }}
            v-btn(
                tile
                color="primary"
                rounded
                @click="showRegister = true"
            )
                | {{ $t('register') }}
        login(v-if="showLogin" :showLogin="showLogin" @close="showLogin = false")
        register(v-if="showRegister" :showRegister="showRegister" @close="showRegister = false")

</template>

<script>
import login from "./front/login";
import register from "./front/register";
import {request} from "../app";

export default {
    name: "Header",
    components: {
        login,
        register
    },
    data() {
        return {
            dark: true,
            langs: [
                {
                    value: 'en',
                    text: 'English'
                },
                {
                    value: 'ka',
                    text: 'ქართული'
                }
            ],
            activeLang: 'ka',
            cartLength: null,
            showLogin: false,
            showRegister: false
        }
    },
    mounted() {
        this.activeLang = this.$store.state.lang
    },
    methods: {
        langImage(lang) {
            return `/icons/${lang}.svg`
        },
        langChanged(lang) {
            this.$store.commit("changeLang", lang)
        },
        logOut() {
            localStorage.removeItem("user");
            this.$store.state.front.isLogged = false
            request.defaults.headers["Authorization"] = null
        },
        setCartLength() {
            this.cartLength = this.$store.state.front.cart.all
        }
    },
    watch: {
        '$store.state.front.cart'() {
            this.setCartLength()
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
