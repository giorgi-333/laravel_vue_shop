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

export default {
    name: "Website",
    components: {
        SiteHeader,
        langChanged
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
