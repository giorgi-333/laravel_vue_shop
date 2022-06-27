<template lang="pug">
    v-app
        site-header
        .pt-16
            router-view
        langChanged(main="true")
</template>

<script>
import SiteHeader from "../components/SiteHeader";
import langChanged from "../components/langChanged";
import {request} from "../app";

export default {
    name: "Website",
    components: {
        SiteHeader,
        langChanged
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
    }
}
</script>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
</style>
