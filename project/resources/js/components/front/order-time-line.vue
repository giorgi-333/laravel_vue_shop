<template>
    <v-timeline class="order-timeline">
        <v-timeline-item
            v-for="(year, i) in years"
            :key="i"
            :color="year.color"
            small
        >
            <template v-slot:opposite>
        <span
            :class="`headline font-weight-bold ${year.color}--text`"
            v-text="year.year"
        ></span>
            </template>
            <div class="py-4">
                <h2 :class="`headline font-weight-light mb-4 ${year.color}--text`">
                    {{ year.title }}
                </h2>
                <div>
                    {{ year.text }}
                </div>
            </div>
        </v-timeline-item>
    </v-timeline>
</template>

<script>
export default {
    name: "orderTimeLine",
    data: () => ({
        years: [
            {
                color: 'green',
                year: '3',
                title: 'მიღება',
                text: 'კურიერი დაგიკვაშირდებათ პროდუქტის მოტანისას და შეგიძლიათ მიღებისას გადაუხადოთ თანხა'
            },
            {
                color: 'cyan',
                year: '2',
                title: 'შეკვეთა',
                text: 'გადადით კალათაში და იქ დამატებული პროდუქტების საყიდლად გამოიყენეთ ღილაკი "ყიდვა". მიუთითეთ მისამართი და საკონტაქტო ნომერი.'
            },
            {
                color: 'amber',
                year: '1',
                title: 'არჩევა',
                text: 'აარჩიეთ სასურველი პროდუქტი, პროდუქტების გვერდიდან შეგიძლიათ იხილოთ ყველა მათგანი. დაამატეთ კალათში სასურველი ფასის ან წონის გათვალისწინებით'
            }
        ],
    })
}
</script>

<style scoped>
.order-timeline {
    max-width: 900px;
    margin: 0 auto;
}
</style>
