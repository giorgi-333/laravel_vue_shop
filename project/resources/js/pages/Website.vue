<template lang="pug">
.webisite(:class="{'dark': hideHeader}")
    site-header(v-if="hideHeader")
    router-view
</template>

<script>
import SiteHeader from "../components/SiteHeader";

export default {
    name: "Website",
    components: {
        SiteHeader
    },
    computed: {
        hideHeader() {
            return this.$route.name !== "meet" && this.$route.name !== "MeetMain"
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
.dark {
    background-color: #333;
    color: whitesmoke;
}
</style>
