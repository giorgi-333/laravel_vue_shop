<template>
    <v-container>
        <lang-changed/>
        <v-row>
            <v-col md="8">
                <v-card class="mb-2">
                    <v-card-title>
                        <v-icon class="mr-2"> mdi-cart</v-icon>
                        კალათა
                    </v-card-title>
                </v-card>
                <v-list two-line v-if="cart && cart.list && cart.list.length">
                    <template v-for="(item,i) in cart.list">
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
                                <v-btn icon @click="deleteItem(item)">
                                    <v-icon color="red darken-2">mdi-delete</v-icon>
                                </v-btn>
                            </v-list-item-action>
                        </v-list-item>
                        <v-divider inset v-if="i !== cart.list.length - 1"></v-divider>
                    </template>
                </v-list>
            </v-col>
            <v-col md="4" v-if="cart && cart.sum">
                <v-card class="mt-3">
                    <v-row>
                        <v-col md="6">
                            <v-card-subtitle> სრული ღირებულება</v-card-subtitle>
                        </v-col>
                        <v-col md="6">
                            <v-card-subtitle class="text-right white--text"> {{ cart.sum }}₾</v-card-subtitle>
                        </v-col>
                    </v-row>
                    <v-row class="px-2">
                        <v-col>
                            <v-dialog
                                v-model="dialog"
                                persistent
                                max-width="600px"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn
                                        large
                                        color="indigo"
                                        class="white--text"
                                        block
                                        v-bind="attrs"
                                        v-on="on"
                                    >
                                        ყიდვა
                                    </v-btn>
                                </template>
                                <v-card>
                                    <v-card-title>
                                        <span class="text-h5">ყიდვა</span>
                                    </v-card-title>
                                    <v-card-text>
                                        <v-container>
                                            <v-row>
                                                <v-col cols="12">
                                                    <v-text-field
                                                        label="მისამართი"
                                                        required
                                                        v-model="order_info.address"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col cols="12">
                                                    <v-text-field
                                                        label="ნომერი"
                                                        required
                                                        v-model="order_info.number"
                                                    ></v-text-field>
                                                </v-col>
                                                <v-col
                                                    cols="12"
                                                    sm="6"
                                                >
                                                    <v-select
                                                        :items="[{value: 1, text: 'ბარათით გადახდა'},{value: 2, text: 'ჩაბარებისას გადახდა'}]"
                                                        v-model="pay_type"
                                                        label="გადახდის ტიპი"
                                                        required
                                                    ></v-select>
                                                </v-col>
                                                <template v-if="pay_type === 1">
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                    >
                                                        <v-text-field
                                                            label="ბარათის ნომერი"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                    >
                                                        <v-text-field
                                                            label="ბარათზე დატანილი სახელი"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                    <v-col
                                                        cols="12"
                                                        sm="6"
                                                    >
                                                        <v-text-field
                                                            label="CVC"
                                                            required
                                                        ></v-text-field>
                                                    </v-col>
                                                </template>
                                            </v-row>
                                        </v-container>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="error darken-1"
                                            text
                                            @click="dialog = false"
                                        >
                                            გაუქმება
                                        </v-btn>
                                        <v-btn
                                            color="blue darken-1"
                                            text
                                            @click="buy"
                                        >
                                            დადასტურება
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import LangChanged from "../../components/langChanged";
//
import {request, bus} from "../../app";

export default {
    name: "cart",
    components: {LangChanged},
    data() {
        return {
            dialog: false,
            order_info: {
                address: null,
                number: null
            },
            pay_type: null
        }
    },
    computed: {
        cart() {
            return this.$store.state.front.cart
        }
    },
    methods: {
        buy() {
            request.post('/api/products/buy', {
                list: this.cart.list,
                info: this.order_info
            })
                .then((res) => {
                    this.dialog = false
                })
        },
        deleteItem(item) {
            console.log(item.product_id);

            request.delete(`/api/cart/${item.product_id}`)
                .then(() => {
                    bus.$emit('cart-changed')
                })

        }
    }
}
</script>

<style scoped>

</style>
