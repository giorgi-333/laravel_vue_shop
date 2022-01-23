<template lang="pug">
.webisite
    site-header
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
body {
    background-color: #333;
    color: whitesmoke;
}
</style>
