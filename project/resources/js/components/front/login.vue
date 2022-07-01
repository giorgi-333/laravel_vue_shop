<template>
    <v-dialog
        width="400"
        v-model="show"
        @click:outside="$emit('close')"
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

            <v-card-text class="error--text" v-if="isError"> სახელი ან პაროლი არასწორია </v-card-text>

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
    props: ["value"],
    emits: ['update:value'],
    data() {
        return {
            loginData: {},
            passwInput: true,
            show: true,
            isError: false
        }
    },
    methods: {
        login() {
            this.$store.dispatch("front/login", this.loginData).then((res) => {
                this.loginData = {}
                this.$emit('close')
                this.isError = false
            })
            .catch(()=> {
                this.isError = true
            })
        },
        selectNext() {
            this.$refs.pasw.focus()
        }
    }
}
</script>

<style scoped>

</style>
