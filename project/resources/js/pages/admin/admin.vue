<template>
    <v-container class="pt-6">
        <v-container v-if="$store.state.admin.isLogged">
            <products-table />
        </v-container>
        <login v-else-if="dialog" />
    </v-container>
</template>

<script>
import productsTable from "../../components/admin/products-table";
import login from "../../components/admin/login";

export default {
    name: "Admin",
    components: {
        productsTable,
        login
    },
    data() {
        return {
            dialog: false,
        }
    },
    mounted() {
        // Check if is logged
        this.$store.dispatch("admin/checkLogin").then(() => {}).catch(() => {
            this.dialog = true
        })
    },
    watch: {
        '$store.state.isLogged'(val) {
            this.dialog = !val
        }
    }
}
</script>

<style>
/*@import "https://cdn.jsdelivr.net/npm/font-awesome@4.x/css/font-awesome.min.css";*/
</style>
