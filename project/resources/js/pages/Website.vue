<template lang="pug">
    v-app
        .content
            site-header
            .pt-16
                router-view
            langChanged(main="true")
        front-footer
</template>

<script>
import SiteHeader from "../components/SiteHeader";
import frontFooter from "../components/front/footer";
//
import langChanged from "../components/langChanged";
//
import {request} from "../app";

export default {
    name: "Website",
    components: {
        SiteHeader,
        langChanged,
        frontFooter
    },
    created() {
        this.$store.dispatch("front/checkLogin").then(() => {
            this.getCart()
        })
    },
    methods: {
        getCart() {
            request.get('/api/cart')
                .then((res) => {
                    this.cart = res.data
                    this.$store.state.front.cartCount = res.data.all
                })
        }
    },
    watch: {
        '$store.state.front.isLogged'() {
            this.getCart()
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
