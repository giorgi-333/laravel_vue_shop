<template>
    <v-container class="pt-6">
        <v-btn
            color="indigo"
            small
            style="float: right;"
            class="mb-2"
            to="/admin"
            exact
        >
            <v-icon>mdi-arrow-left-bold</v-icon>
        </v-btn>
        <v-container style="clear: both;" v-if="$store.state.isLogged">
            <v-row>
                <v-col md="6">
                    <v-card class="px-4">
                        <v-row>
                            <v-card-title outlined> 🇬🇪 ქართული</v-card-title>
                        </v-row>
                        <v-row>
                            <v-col md="5">
                                <v-text-field
                                    label="სახელი"
                                    hide-details="auto"
                                    outlined
                                    v-model="product.ka.name"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                    outlined
                                    label="აღწერა"
                                    value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                    no-resize
                                    v-model="product.ka.descr"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>

                <v-col md="6">
                    <v-card class="px-4">
                        <v-row>
                            <v-card-title outlined> 🇺🇸 ინგლისური</v-card-title>
                        </v-row>
                        <v-row>
                            <v-col md="5">
                                <v-text-field
                                    label="სახელი"
                                    hide-details="auto"
                                    outlined
                                    v-model="product.en.name"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-textarea
                                    outlined
                                    label="აღწერა"
                                    value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                    no-resize
                                    v-model="product.en.descr"
                                ></v-textarea>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>

            </v-row>
            <v-row>
                <v-col md="6">
                    <v-card
                        class="mx-auto"
                        max-width="374"
                    >
                        <v-icon large style="position: absolute; right: 4px; z-index: 9">mdi-eye</v-icon>
                        <v-img
                            height="250"
                            :src="product.image"
                        ></v-img>

                        <v-card-title>{{ product.name }}</v-card-title>

                        <v-card-text>
                            <div class="my-4 text-subtitle-1" v-if="product.price">
                                {{ product.price }} ₾
                            </div>

                            <div>
                                {{ product.descr }}
                            </div>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col md="6">
                    <v-card
                        class="mx-auto mt-3 pa-3"
                        max-width="374"
                    >
                        <v-row>
                            <v-col md="6">
                                <v-text-field
                                    label="ფასი"
                                    hide-details="auto"
                                    outlined
                                    v-model="product.price"
                                ></v-text-field>
                            </v-col>
                            <v-col md="6">
                                <v-text-field
                                    label="რაოდენობა"
                                    hide-details="auto"
                                    outlined
                                    v-model="product.count"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col>
                                <v-file-input
                                    accept="image/png, image/jpeg, image/bmp"
                                    prepend-icon="mdi-file-image"
                                    placeholder="ატვირთვა"
                                    label="ატვირთეთ ფოტო"
                                    v-model="product.img"
                                ></v-file-input>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-btn
                                depressed
                                color="indigo"
                                class="mx-auto mb-6"
                                @click="addProduct"
                            >
                                გამოქყვეყნება
                            </v-btn>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>
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
import {request} from "../../app";

export default {
    name: "Admin",
    data() {
        return {
            product: {
                price: null,
                count: null,
                ka: {
                    name: null,
                    descr: null
                },
                en: {
                    name: null,
                    descr: null
                },
                img: null,
                image: null
            },
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

        if(this.$route.params.slug) {
            this.getProduct()
        }
    },
    methods: {
        addProduct() { // 0 - ka // 1 - en
            const data = new FormData();
            data.append('ka[name]', this.product.ka.name)
            data.append('en[name]', this.product.en.name)
            data.append('img', this.product.img)
            data.append('ka[descr]', this.product.ka.descr)
            data.append('en[descr]', this.product.en.descr)
            data.append('price', this.product.price)
            data.append('count', this.product.count)
            // parameters['columns[0][data]'] = '';
            request.post("/api/product/", data)
                .then((response) => {
                    alert("დაემატა!")
                    console.log(response)
                })
        },
        login() {
            this.$store.dispatch("login", this.loginData).then(() => {
                this.loginData = {}
            })
        },
        selectNext() {
            this.$refs.pasw.focus()
        },
        getProduct() {
            request.get(`/api/admin/products/${this.$route.params.slug}`)
                .then((response) => {
                    this.product = response.data
                })
        },
    },
    watch: {
        'product.img'(val) {
            if (val.name) {
                this.product.image = URL.createObjectURL(val)
            }
            else if(val) {}
            else {
                this.product.image = null
            }
        },
        '$store.state.isLogged'(val) {
            this.dialog = !val
        }
    }
}
</script>

<style>
/*@import "https://cdn.jsdelivr.net/npm/font-awesome@4.x/css/font-awesome.min.css";*/
</style>
