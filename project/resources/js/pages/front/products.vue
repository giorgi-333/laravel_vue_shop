<template>
    <div class="cont">
        <div class="products mt-4">
            <v-card
                class="mx-auto"
                max-width="374"
                v-for="product in products"
                :key="product.id"
                :to="{ name:'product', params: { slug: product.slug } }"
            >
                <template slot="progress">
                    <v-progress-linear
                        color="deep-purple"
                        height="10"
                        indeterminate
                    ></v-progress-linear>
                </template>

                <v-img
                    height="250"
                    :src="product.img"
                ></v-img>

                <v-card-title class="pb-0">{{ product.name }}</v-card-title>

                <v-card-text>
                    <div class="my-1 text-subtitle-1">
                        {{ product.price }} ₾
                    </div>

                    <div>
                        {{ product.descr }}
                    </div>
                </v-card-text>
            </v-card>
        </div>
    </div>
</template>

<script>
import {request} from "../../app";

export default {
    name: "products",
    data() {
        return {
            products: []
        }
    },
    mounted() {
        this.fetchProducts()
    },
    methods: {
        fetchProducts() {
            request.get('/api/products')
                .then((response) => {
                    this.products = response.data
                })
        },
    }
}
</script>

<style scoped>
.cont {
    max-width: 1400px;
    margin: 0 auto;
}

.products {
    display: grid;
    grid-template-columns: repeat(auto-fill, 374px);
    gap: 30px;
    justify-content: space-around;
}
</style>
