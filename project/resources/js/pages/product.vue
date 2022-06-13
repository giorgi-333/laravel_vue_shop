<template>
    <v-container>
        <lang-changed @langChanged="rame"/>
        <v-row
            class="mb-6"
            no-gutters
        >
            <v-col
                md="6"
            >
                <v-img :src="product.img"> </v-img>
            </v-col>
            <v-col
                md="6"
            >
                <v-container>
                    <v-card-title> {{ product.name }} </v-card-title>
                    <v-divider/>
                    <v-card-text>ფასი: {{ product.price }}₾</v-card-text>
                    <v-card-text> {{ product.descr }} </v-card-text>
                    <v-row justify="start" align="center">
                        <v-col md="4">
                            <v-text-field
                                outlined
                                hide-details='true'
                                v-model="sale.count"
                                prepend-inner-icon="mdi-minus"
                                append-icon="mdi-plus"
                                class="text-center"
                                @click:prepend-inner="countDecrement(); countChanged()"
                                @click:append="sale.count++; countChanged()"
                                label="კილოგრამი"
                                @input="countChanged"
                                @wheel="countChangeOnWheel"
                            ></v-text-field>
                        </v-col>
                        <v-col md="auto">
                            <v-btn
                                tile
                                color="success"
                            >
                                <v-icon left>
                                    mdi-cart-outline
                                </v-icon>
                                დამატება
                            </v-btn>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col md="3">
                            <v-text-field
                                outlined
                                hide-details='true'
                                v-model="sale.price"
                                class="text-center"
                                label="თანხა"
                                append-icon="₾"
                                @input="priceChanged"
                                @wheel="priceChangeOnWheel"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                </v-container>
            </v-col>
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
        rame() {
            console.log(1)
        },
        countDecrement() {
            if(this.sale.count > 1) this.sale.count--
        },
        countChanged() {
            this.sale.price = Math.round((this.sale.count * this.product.price) * 100) / 100
        },
        priceChanged() {
            this.sale.count = Math.round((this.sale.price / this.product.price) * 100) / 100
        },
        countChangeOnWheel(e) {
            if(e.deltaY < 0) this.sale.count++
            else if (this.sale.count > 1) this.sale.count--
            // call count changed
            this.countChanged()
        },
        priceChangeOnWheel(e) {
            if(e.deltaY < 0) this.sale.price++
            else if (this.sale.price > 1) this.sale.price--
            // call price changed
            this.priceChanged()
        }
    }
}
</script>

<style>
.text-center input {
    text-align: center;
}
</style>
