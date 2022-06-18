<template>
    <v-container class="pt-6">
        <v-container v-if="$store.state.isLogged">
            <products-table />
        </v-container>
        <v-dialog
            v-model="dialog"
            width="400"
            v-else
            persistent
        >
            <v-card>
                <v-card-title class="text-h5">
                    შესვლა
                </v-card-title>

                <v-card-text>
                    <v-text-field v-model="loginData.name" label="მომხმარებელი" outlined class="mt-4"
                                  @keyup.enter="selectNext">
                    </v-text-field>
                    <v-text-field v-model="loginData.password" label="პაროლი" outlined
                                  hide-details="true"
                                  :append-icon="passwInput ? 'mdi-eye-off' : 'mdi-eye'"
                                  :type="passwInput ? 'password' : 'text' "
                                  @click:append="passwInput = !passwInput"
                                  @keyup.enter="login"
                                  ref="pasw"
                    ></v-text-field>
                </v-card-text>

                <v-card-actions class="pb-6">
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        @click="login"
                    >
                        შესვლა
                    </v-btn>
                    <v-spacer></v-spacer>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-container>
</template>

<script>
import productsTable from "../../components/admin/products-table";

export default {
    name: "Admin",
    components: {
        productsTable
    },
    data() {
        return {
            dialog: false,
            loginData: {},
            passwInput: true
        }
    },
    mounted() {
        // Check if is logged
        this.$store.dispatch("checkLogin").then(() => {
        }).catch(() => {
            this.dialog = true
        })
    },
    methods: {
        login() {
            this.$store.dispatch("login", this.loginData).then(() => {
                this.loginData = {}
            })
        },
        selectNext() {
            this.$refs.pasw.focus()
        }
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
