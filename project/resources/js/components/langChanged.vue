<template>
</template>

<script>
import {request} from "../app";

export default {
    name: "langChanged",
    props: ["main"],
    computed: {
        lang() {
            return this.$store.state.lang
        }
    },
    watch: {
        lang(val) {

            this.$i18n.locale = val

            if (this.main) {
                request.defaults.headers["Accept-Language"] = val
            } else {
                this.$nextTick(() => {
                    this.$emit("langChanged")
                })
            }
        }
    }
}
</script>

<style scoped>
</style>
