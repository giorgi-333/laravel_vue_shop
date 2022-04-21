<template lang="pug">
v-app
    site-header
    .pt-16
        router-view
</template>

<script>
import SiteHeader from "../components/SiteHeader";

export default {
    name: "Website",
    components: {
        SiteHeader
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
