<template>
    <v-dialog
        width="400"
        v-model="show"
        @click:outside="$emit('close')"
    >
        <v-card>
            <v-card-title class="text-h5">
                {{ $t('register') }}
            </v-card-title>

            <v-card-text>
                <v-text-field v-model="loginData.name" label="მეილი ან მომხმარებელი" outlined class="mt-4"
                              @keyup.enter="selectNext">
                </v-text-field>
                <v-text-field v-model="loginData.password" label="პაროლი" outlined
                              hide-details="true"
                              :append-icon="passwInput ? 'mdi-eye-off' : 'mdi-eye'"
                              :type="passwInput ? 'password' : 'text' "
                              @click:append="passwInput = !passwInput"
                              @keyup.enter="register"
                              ref="pasw"
                ></v-text-field>
            </v-card-text>

            <v-card-text class="error--text" v-if="isError"> შეავსეთ მონაცემები</v-card-text>

            <v-card-actions class="pb-6">
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    @click="register"
                >
                    {{ $t('register') }}
                </v-btn>
                <v-spacer></v-spacer>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import {request} from "../../app";

export default {
    name: "login",
    data() {
        return {
            loginData: {
                name: '',
                password: ''
            },
            passwInput: true,
            show: true,
            isError: false
        }
    },
    methods: {
        register() {
            if (this.loginData.name == '' || this.loginData.password == '') {
                this.isError = true
            } else {
                this.isError = false

                //
                return request.post('/api/create-user', this.loginData)
                    .then(() => {
                        this.show = false
                    })
            }
        },
        selectNext() {
            this.$refs.pasw.focus()
        }
    }
}
</script>

<style scoped>

</style>
