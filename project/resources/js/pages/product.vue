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
                    <v-card-text>ფასი: {{ product.price }} </v-card-text>
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
            product: {}
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
                })
        },
        rame() {
            console.log(1)
        }
    }
}
</script>
