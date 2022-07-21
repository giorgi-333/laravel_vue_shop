<template>
    <v-container>
        <lang-changed :main="true"/>
        <v-data-table
            :headers="headers"
            :items="products"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title class="width-140"> {{ $t('products') }}</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-tabs
                        fixed-tabs
                        v-model="selectedLang"
                    >
                        <v-tabs-slider></v-tabs-slider>
                        <v-tab
                            href="#ka"
                            class="primary--text"
                            @click="langChange('ka')"
                        >
                            <v-img src="/icons/ka.svg" max-width="30px"/>
                        </v-tab>

                        <v-tab
                            href="#en"
                            class="primary--text"
                            @click="langChange('en')"
                        >
                            <v-img src="/icons/en.svg" max-width="30px"/>
                        </v-tab>
                    </v-tabs>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="primary"
                        dark
                        class="mb-2"
                        :to="{name: 'adminAdd'}"
                    >
                        {{ $t('add') }}
                    </v-btn>
                    <v-dialog v-model="dialogDelete" max-width="500px">
                        <v-card>
                            <v-card-title class="text-h5">ნამდვილად გსურთ წაშლა?</v-card-title>
                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="blue darken-1" text @click="closeDelete">არა</v-btn>
                                <v-btn color="blue darken-1" text @click="deleteItemConfirm">კი</v-btn>
                                <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <div style="min-width: 45px;">
                    <v-icon
                        small
                        class="mr-2"
                        @click="editItem(item)"
                    >
                        mdi-pencil
                    </v-icon>
                    <v-icon
                        small
                        @click="deleteItem(item)"
                    >
                        mdi-delete
                    </v-icon>
                </div>
            </template>
            <template v-slot:item.img="{ item }">
                <v-img :src="item.img" width="35px" height="35px"/>
            </template>
            <template v-slot:no-data>
                <v-btn
                    color="primary"
                    @click="getData"
                >
                    Reset
                </v-btn>
            </template>
        </v-data-table>
    </v-container>
</template>

<script>
import {request} from "../../app";
import LangChanged from "../langChanged";

export default {
    name: 'productsTable',
    components: {LangChanged},
    data: () => ({
        dialogDelete: false,
        desserts: [],
        editedItem: {},
        products: [],
        selectedLang: null
    }),

    computed: {
        formTitle() {
            return 'Edit Item'
        },
        headers() {
            return [
                {
                    text: this.$t('img'),
                    align: 'start',
                    sortable: false,
                    value: 'img',
                },
                {text: this.$t('name'), sortable: false, value: 'name'},
                {text: this.$t('descr'), value: 'descr', sortable: false},
                {text: this.$t('price'), value: 'price'},
                {text: this.$t('count'), value: 'count'},
                {text: 'Actions', value: 'actions', sortable: false}
            ]
        }
    },

    watch: {
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.getData()
        this.selectedLang = this.$store.state.lang
    },

    methods: {
        getData() {
            request.get('/api/products')
                .then((response) => {
                    this.products = response.data
                })
        },

        editItem(item) {
            this.$router.push({name: 'adminEdit', params: {slug: item.slug}})
        },

        deleteItem(item) {
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            request.delete(`/api/admin/products/${this.editedItem.slug}`)
                .then((response) => {
                    this.product = response.data
                    this.getData()
                })
            //
            this.closeDelete()
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, {})
            })
        },

        langChange(lang) {
            this.$store.state.lang = lang
            this.$nextTick(() => {
                this.getData()
            })
        }
    },
}
</script>

<style scoped>
.width-140 {
    min-width: 140px !important;
}
</style>
