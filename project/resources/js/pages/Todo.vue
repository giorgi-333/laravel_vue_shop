<template lang="pug">
.page
    .container
        .head Todo App
        .add-cont
            input(v-model="value" @keyup.enter="addTodo")
            .add(@click="addTodo") +
        .list
            .item(v-for="item in todo" @click="doneTodo(item.id)" :class="{'done': isDone(item.id)}") {{item.text}}
</template>

<script>
export default {
    name: 'ExampleComponent',
    data() {
        return {
            todo: [],
            value: null,
            doneTodos: []
        }
    },
    mounted() {
        // this.fetchAllTodo()
    },
    methods: {
        fetchAllTodo() {
            axios.get('/api/todo')
                .then((response) => {
                    this.todo = response.data
                    this.todo.forEach(item => {
                        if(item.done)
                            this.doneTodos.push(item.id)
                    })
                })
        },
        addTodo() {
            axios.post('/api/todo',{text: this.value})
                .then((response) => {
                    this.todo.push({text: this.value})
                    this.value = null
                })
        },
        doneTodo(id) {
            const idIndex = this.doneTodos.indexOf(id)
            if(idIndex === -1) {
                this.doneTodos.push(id)
            }
            else {
                this.doneTodos.splice(idIndex, 1)
            }
        },
        isDone(id) {
            return this.doneTodos.includes(id)
        }
    }
}
</script>

<style>
.page {
    width: 100%;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.page {
    .container {
        padding: 20px;
        border: 1px solid #0a53be;
        border-radius: 4px;
        box-shadow: 2px 2px 10px rgba(10, 83, 190, 0.57);

        .head {
            font-size: 30px;
        }
        .add-cont {
            display: grid;
            grid-template-columns: 270px 39px;
            grid-column-gap: 5px;
            margin-top: 5px;
            margin-bottom: 10px;

            input {
                font-size: 22px;
                padding: 5px 10px;
                border: 1px solid #0a53be;
                border-radius: 4px;

                &:focus {
                    outline: none;
                }
            }
            .add {
                cursor: pointer;
                line-height: 39px;
                background-color: #0a53be;
                border-radius: 4px;
                color: white;
                text-align: center;
                font-size: 30px;
            }
        }
        .list {
            font-size: 22px;
            max-height: 400px;
            overflow-y: auto;

            .item {
                cursor: pointer;
                user-select: none;
                margin: 5px 0;
                padding: 8px 15px;
                box-shadow: 2px 2px 10px rgba(245, 245, 245, 0.62);
                background-color: #0a53be;
                border-radius: 4px;

                &.done {
                    text-decoration: line-through;
                }
            }
        }
    }
}
</style>

