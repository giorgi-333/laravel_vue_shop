<template>
</template>

<script>
import {request} from "../app";

export default {
    name: "langChanged",
    computed: {
        lang() {
            return this.$store.state.lang
        }
    },
    watch: {
        lang(val) {
            request.defaults.headers["Accept-Language"] = val
            this.$nextTick(()=> {
                this.$emit("langChanged")
                this.$i18n.locale = val
            })
        }
    }
}
</script>

<style scoped>
</style>
