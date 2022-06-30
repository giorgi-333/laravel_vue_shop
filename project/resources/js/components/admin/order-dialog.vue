<template>
    <v-dialog
        v-model="dialog"
        width="500"
        persistent
    >
        <v-card>
            <v-card-title class="text-h5">
                ინფორმაცია შეკვეთაზე
            </v-card-title>

            <v-data-table
                :headers="headers"
                :items="data"
                sort-by="calories"
                class="elevation-1"
            >
                <template v-slot:item.slug="{ item }">
                    <v-btn
                        color="indigo"
                        :to="'/products/'+item.slug"
                        target="_blank"
                    >
                        {{ item.slug }}
                    </v-btn>
                </template>
            </v-data-table>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="primary"
                    text
                    @click="$emit('close')"
                >
                    დახურვა
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "order-dialog",
    props: ['data'],
    data() {
        return {
            dialog: true
        }
    },
    computed: {
        headers() {
            return [
                {text: this.$t('count') + ' - კგ', sortable: false, value: 'count'},
                {text: this.$t('price') + ' - ₾', value: 'price', sortable: false},
                {text: this.$t('slug') + ' - პროდუქტი', value: 'slug'}
            ]
        }
    }
}
</script>

<style scoped>

</style>
