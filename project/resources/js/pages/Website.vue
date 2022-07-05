<template lang="pug">
    v-app
        .content
            site-header
            .pt-16
                router-view
            langChanged(main="true" @langChanged="getCart")
        front-footer
</template>

<script>
import SiteHeader from "../components/SiteHeader";
import frontFooter from "../components/front/footer";
//
import langChanged from "../components/langChanged";
//
import {bus, request} from "../app";

export default {
    name: "Website",
    components: {
        SiteHeader,
        langChanged,
        frontFooter
    },
    created() {
        this.$store.dispatch("front/checkLogin").then(() => {
        })
        //
        bus.$on("cart-changed", () => {
            this.getCart()
        });
    },
    methods: {
        getCart() {
            request.get('/api/cart')
                .then((res) => {
                    this.$store.state.front.cart = res.data
                }).catch(() => {
                this.$store.state.front.cart = {}
            })
        }
    },
    watch: {
        '$store.state.front.isLogged'() {
            this.$nextTick(()=> {
                this.getCart()
            })
        }
    }
}
</script>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.content {
    min-height: calc(100vh - 161px);
    padding-bottom: 40px;
}
</style>
