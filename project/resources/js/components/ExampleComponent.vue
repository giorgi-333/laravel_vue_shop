<template lang="pug">
.page
    .container
        .head Todo App
        input(v-model="value")
        .list
            .item(v-for="item in todo") {{item.text}}
</template>

<style lang="scss">
.container {
    border: 1px solid burlywood;
}
</style>

<script>
export default {
    data() {
        return {
            todo: [],
            value: null,
        }
    },
    mounted() {
        this.fetchAllTodo()
    },
    methods: {
        fetchAllTodo() {
            axios.get('/api/todo')
                .then((response) => {
                    this.todo = response.data
                    console.log(response.data)
                })
        }
    }
}
</script>
