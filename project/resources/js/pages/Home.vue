<template>
    <div class="products pa-10">
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

            <v-card-title>{{ product.name }}</v-card-title>

            <v-card-text>
                <div class="my-4 text-subtitle-1">
                    {{ product.price }} ₾
                </div>

                <div>
                    {{ product.descr }}
                </div>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
export default {
    name: "Home",
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
            axios.get('/api/products')
                .then((response) => {
                    this.products = response.data
                })
        },
    }
}
</script>

<style lang="scss">
.products {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fill, 374px);
    gap: 30px;
    justify-content: space-around;
}
</style>


