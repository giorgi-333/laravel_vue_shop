<template>
    <v-container class="pt-6">
        <v-row>
            <v-col md="6">
                <v-card class="px-4">
                    <v-row>
                        <v-card-title outlined> 🇬🇪 ქართული </v-card-title>
                    </v-row>
                    <v-row>
                        <v-col md="5">
                            <v-text-field
                                label="სახელი"
                                hide-details="auto"
                                outlined
                                v-model="product.name"
                            ></v-text-field>
                        </v-col>
                        <v-col md="3">
                            <v-text-field
                                label="ფასი"
                                hide-details="auto"
                                outlined
                                v-model="product.price"
                            ></v-text-field>
                        </v-col>
                        <v-col md="4">
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
                            <v-textarea
                                outlined
                                label="აღწერა"
                                value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                no-resize
                                v-model="product.descr"
                            ></v-textarea>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>

            <v-col md="6">
                <v-card class="px-4">
                    <v-row>
                        <v-card-title outlined> 🇺🇸 ინგლისური </v-card-title>
                    </v-row>
                    <v-row>
                        <v-col md="5">
                            <v-text-field
                                label="სახელი"
                                hide-details="auto"
                                outlined
                                v-model="product.name"
                            ></v-text-field>
                        </v-col>
                        <v-col md="3">
                            <v-text-field
                                label="ფასი"
                                hide-details="auto"
                                outlined
                                v-model="product.price"
                            ></v-text-field>
                        </v-col>
                        <v-col md="4">
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
                            <v-textarea
                                outlined
                                label="აღწერა"
                                value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                                no-resize
                                v-model="product.descr"
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
                    <v-icon large style="position: absolute; right: 4px; z-index: 9"> mdi-eye </v-icon>
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
</template>

<script>
export default {
    name: "Admin",
    data() {
        return {
            product: {
                name: null,
                price: null,
                count: null,
                descr: null,
                img: null,
                image: null
            },
            PostSelectedLang: "ka"
        }
    },
    methods: {
        addProduct() {
            const data = new FormData();
            data.append('name', this.product.name)
            data.append('img', this.product.img)
            data.append('descr', this.product.descr)
            data.append('price', this.product.price)
            data.append('count', this.product.count)

            axios.post("/api/products/",data)
                .then((response) => {
                    alert("დაემატა!")
                    console.log(response)
                })
        }
    },
    watch: {
        'product.img'(val) {
            if(val) {
                this.product.image = URL.createObjectURL(val)
            } else {
                this.product.image = null
            }
        }
    }
}
</script>

<style>
/*@import "https://cdn.jsdelivr.net/npm/font-awesome@4.x/css/font-awesome.min.css";*/
</style>
