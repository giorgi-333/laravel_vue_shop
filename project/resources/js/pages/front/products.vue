<template>
    <div class="cont">
        <lang-changed @langChanged="fetchProducts"/>
        <v-parallax
            dark
            src="https://images.unsplash.com/photo-1620278596990-fdf04885f5b6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80"
        >
            <v-row
                align="center"
                justify="center"
            >
                <v-col
                    class="text-center"
                    cols="12"
                >
                    <h1 class="mb-4 orange--text elevation-15">
                        აირჩიე ჯანსაღი პროდუქტი
                    </h1>
                </v-col>
            </v-row>
        </v-parallax>
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
import langChanged from "../../components/langChanged";

export default {
    name: "products",
    components: {
        langChanged
    },
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

.orange--text {
    text-shadow: 2px 2px 8px #0f05df;
}
</style>
