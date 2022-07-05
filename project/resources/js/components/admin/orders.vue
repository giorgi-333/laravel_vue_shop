<template>
    <v-container>
        <v-data-table
            :headers="headers"
            :items="orders"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title class="width-140"> შეკვეთები</v-toolbar-title>
                </v-toolbar>
            </template>
            <template v-slot:item.id="{ item }">
                {{ item.id }}
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    class="mr-2"
                    @click="info(item)"
                    color="primary"
                >
                    mdi-information-outline
                </v-icon>
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
        <order-dialog v-if="dialog" :data="info_data" @close="dialog = false"/>
    </v-container>
</template>

<script>
import {request} from "../../app";
import orderDialog from "../../components/admin/order-dialog"

export default {
    components: {
        orderDialog
    },
    data: () => ({
        desserts: [],
        editedItem: {},
        orders: [],
        count_index: 0,
        dialog: false,
        info_data: []
    }),
    computed: {
        formTitle() {
            return 'Edit Item'
        },
        headers() {
            return [
                {
                    text: this.$t('id'),
                    align: 'start',
                    sortable: false,
                    value: 'id',
                },
                {text: this.$t('name'), sortable: false, value: 'name'},
                {text: this.$t('address'), value: 'address', sortable: false},
                {text: this.$t('number'), value: 'number'},
                {text: 'Actions', value: 'actions', sortable: false}
            ]
        }
    },

    created() {
        this.$store.dispatch("front/checkLogin").then(() => {
            this.getData()
        }).catch(() => {
            this.$router.push({name: 'admin'})
        })
    },

    methods: {
        getData() {
            request.get('/api/buy/list')
                .then((response) => {
                    this.orders = response.data
                })
        },
        info(item) {

            request.get('/api/buy/info', {
                params: {
                    id: item.id
                }
            })
                .then((res) => {
                    this.info_data = res.data
                    this.dialog = true
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
