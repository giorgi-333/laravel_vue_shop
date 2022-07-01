<template>
    <v-dialog
        width="400"
        persistent
        v-model="show"
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
</template>

<script>
export default {
    name: "login",
    data() {
        return {
            loginData: {},
            passwInput: true,
            show: true
        }
    },
    methods: {
        login() {
            this.$store.dispatch("admin/login", this.loginData).then(() => {
                this.loginData = {}
            })
        },
        selectNext() {
            this.$refs.pasw.focus()
        }
    },
}
</script>

<style scoped>

</style>
