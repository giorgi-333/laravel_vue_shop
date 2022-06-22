<template>
    <v-container>
        <lang-changed @langChanged="getProduct"/>
        <v-row
            class="mb-6"
            no-gutters
        >
            <v-col
                md="6"
            >
                <v-img :src="product.img"></v-img>
            </v-col>
            <v-col
                md="6"
            >
                <v-container>
                    <v-card-title> {{ product.name }}</v-card-title>
                    <v-divider/>
                    <v-card-title>{{ product.price }}₾</v-card-title>
                    <v-row justify="start" align="center" class="mt-6">
                        <v-col md="4">
                            <v-text-field
                                outlined
                                hide-details='true'
                                v-model="sale.count"
                                prepend-inner-icon="mdi-minus"
                                append-icon="mdi-plus"
                                class="text-center"
                                @click:prepend-inner="countDecrement(); countChanged()"
                                @click:append="sale.count=plusOne(sale.count); countChanged()"
                                :label="$t('kilogram')"
                                @input="countChanged"
                                @wheel="countChangeOnWheel"
                            ></v-text-field>
                        </v-col>
                        <v-col md="auto">
                            <v-btn
                                color="success"
                                rounded
                                @click="addToCart"
                            >
                                <v-icon left>
                                    mdi-cart-outline
                                </v-icon>
                                {{ $t('add') }}
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row align="center">
                        <v-col md="3">
                            <v-text-field
                                outlined
                                hide-details='true'
                                v-model="sale.price"
                                class="text-center"
                                :label="$t('price')"
                                append-icon="₾"
                                @input="priceChanged"
                                @wheel="priceChangeOnWheel"
                            ></v-text-field>
                        </v-col>
                        <v-col md="auto">
                            <v-btn
                                color="primary"
                                fab
                                small
                                :disabled="sale.count === 1"
                                @click="sale.count = 1; countChanged()"
                            >
                                <v-icon>mdi-autorenew</v-icon>
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-container>
            </v-col>
        </v-row>
        <v-row>
            <v-card-title> {{ $t('descr') }} </v-card-title>
            <v-card-text> {{ product.descr }}</v-card-text>
        </v-row>
    </v-container>
</template>

<script>
import langChanged from "../components/langChanged";
import {request} from "../app";

export default {
    name: "product",
    components: {
        langChanged
    },
    data() {
        return {
            product: {},
            sale: {
                count: 1,
                price: null,
                weight: null
            },
            show: true,
            byCount: true
        }
    },
    mounted() {
        this.getProduct()
    },
    methods: {
        getProduct() {
            request.get(`/api/products/${this.$route.params.slug}`)
                .then((response) => {
                    this.product = response.data
                    this.countChanged()
                })
        },
        countDecrement() {
            if (this.sale.count > 1) this.sale.count = this.minusOne(this.sale.count)
        },
        countChanged() {
            this.sale.price = Math.round((this.sale.count * this.product.price) * 100) / 100
        },
        priceChanged() {
            this.sale.count = Math.round((this.sale.price / this.product.price) * 100) / 100
        },
        countChangeOnWheel(e) {
            if (e.deltaY < 0) this.sale.count = this.plusOne(this.sale.count)
            else if (this.sale.count > 1) this.sale.count = this.minusOne(this.sale.count)
            // call count changed
            this.countChanged()
        },
        priceChangeOnWheel(e) {
            if (e.deltaY < 0) this.sale.price = this.plusOne(this.sale.price)
            else if (this.sale.price > 1) this.sale.price = this.minusOne(this.sale.price)
            // call price changed
            this.priceChanged()
        },
        minusOne(val) {
            let numb = Number(val) - 1
            if (numb % 1 > 0) numb = Math.round((numb) * 100) / 100
            return numb
        },
        plusOne(val) {
            let numb = Number(val) + 1
            if (numb % 1 > 0) numb = Math.round((numb) * 100) / 100
            return numb
        },
        //    Add to cart
        addToCart() {
            let cart

            if(localStorage.cart) {
                cart = JSON.parse(localStorage.cart)
                cart[this.product.slug] = {
                    name: this.product.name,
                    img: this.product.img,
                    price: this.sale.price
                }
                localStorage.cart = JSON.stringify(cart)
            } else {
                cart = {}
                cart[this.product.slug] = {
                    name: this.product.name,
                    img: this.product.img,
                    price: this.sale.price
                }
                localStorage.cart = JSON.stringify(cart)
            }
            this.$store.state.changedCart = !this.$store.state.changedCart
        }
    }
}
</script>

<style>
.text-center input {
    text-align: center;
}
</style>
