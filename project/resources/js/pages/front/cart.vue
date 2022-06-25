<template>
    <v-container>
        <v-row>
            <v-col md="8">
                <v-card class="mb-2">
                    <v-card-title>
                        <v-icon class="mr-2"> mdi-cart</v-icon>
                        კალათა
                    </v-card-title>
                </v-card>
                <v-list two-line>
                    <template v-for="(item,i) in cart">
                        <v-list-item>
                            <!-- image -->
                            <v-list-item-avatar>
                                <v-img :src="item.img"></v-img>
                            </v-list-item-avatar>
                            <!-- content -->
                            <v-list-item-content>
                                <v-list-item-title v-text="item.name"></v-list-item-title>

                                <v-list-item-subtitle> {{ item.cart_count }}კგ - {{
                                        item.cart_price
                                    }}₾
                                </v-list-item-subtitle>
                            </v-list-item-content>
                            <!-- actions -->
                            <v-list-item-action>
                                <v-btn icon>
                                    <v-icon color="red darken-2">mdi-delete</v-icon>
                                </v-btn>
                            </v-list-item-action>
                        </v-list-item>
                        <v-divider inset v-if="i !== cart.length - 1"></v-divider>
                    </template>
                </v-list>
            </v-col>
            <v-col md="4">
                <v-card class="mt-3">
                    <v-row>
                        <v-col md="6">
                            <v-card-subtitle> სრული ღირებულება</v-card-subtitle>
                        </v-col>
                        <v-col md="6">
                            <v-card-subtitle class="text-right white--text"> 98₾</v-card-subtitle>
                        </v-col>
                    </v-row>
                    <v-row class="px-2">
                        <v-col>
                            <v-btn large color="indigo" class="white--text" block>
                                ყიდვა
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import {request} from "../../app";

export default {
    name: "cart",
    data() {
        return {
            cart: []
        }
    },
    mounted() {
        this.getCart()
    },
    methods: {
        getCart() {
            request.get('/api/cart')
                .then((res) => {
                    this.cart = res.data
                })
        }
    },
    watch: {
        '$store.state.isLogged'() {
            this.getCart()
        }
    }
}
</script>

<style scoped>

</style>
