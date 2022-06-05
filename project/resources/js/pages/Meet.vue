<template lang="pug">
.cont
    .meet
       .desc
           h1 უფასო ონლაინ ჩათი, რეგისტრაციის გარეშე
           p საიტი საშუალებას გაძლევთ რეგისტრაციის გარეშე მიწეროთ სასურველ საიტზე მყოფ ადამიანს. ამისთვის არ გჭირდებათ პირადული ინფორმაციის გაცემა.
           .together
               img(src="/icon/love.png")
               p.active გაიცანი და მიწერე მარტო მყოფ გოგოებს თუ ბიჭებს, ნებისმიერი ლიმიტის გარეშე.
           .together
               p მიიღე მეგობრული მიმოწერები, ასევე შეგიძლიათ დაგვეხმაროთ სპამების დაბლოკვაში, რომ არ მიიღოთ ვირუსული ლინკები
               img.active(src="/icon/currier.png")
       .form
           h1 მონაცემები
           input(type="text" placeholder="სახელი" v-model="data.name" )
           input(type="text" placeholder="პაროლი" v-model="data.password" )
           .checks
               label.check.boy(:class="{'checked': checked === 1}" @click="checked=1")
                    input(type="radio" name="gender")
                    span ბიჭი
               label.check.girl(:class="{'checked': checked === 2}" @click="checked=2")
                    input(type="radio" name="gender")
                    span გოგო
           select(v-model="data.age")
            option(v-for="age in ages") {{ age }}
           button(@click="startChat") დაწყება
    img(src="/icon/wave.svg")
</template>

<script>
export default {
    name: "Meet",
    data() {
        return {
            checked: null,
            data: {}
        }
    },
    mounted() {
        // axios.get('/api/user').then(res => {
        //     console.log(res);
        // });
    },
    methods: {
        startChat() {
            this.$router.push({name: "MeetMain"})
        },
        start() {
            this.data.age = parseInt(this.data.age)
            axios.post('/api/create-user',this.data)
                .then((res) => {
                    console.log(res);
                })
        },

    },
    computed: {
        ages() {
            let ages = ["ასაკი"]
            for(let age=18; age < 40; age++) {
                ages.push(age)
            }
            ages.push("40+")
            return ages
        }
    }
}
</script>

<style lang="scss" scoped>
.cont {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #4b55c1;

    & > img {
        width: 100%;
        position: absolute;
        left: 0;
        bottom: -70px;
    }

    .meet {
        max-width: max-content;
        display: grid;
        grid-template-columns: 390px 320px;
        justify-content: center;
        align-items: center;
        box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
        border-radius: 8px;
        overflow: hidden;

        .desc {
            padding: 20px;
            background-color: #fff;

            & > h1 {
                margin-bottom: 40px;
                font-weight: normal;
                color: #648dec;
            }

            & > p {
                text-align: center;
            }

            .together {
                display: grid;
                grid-template-columns: auto auto;
                gap: 10px;
                margin: 20px 0;

                p.active {
                    color: #306ef5;
                    font-style: italic;
                }

                img {
                    width: 80px;
                    filter: invert(64%) sepia(29%) saturate(6214%) hue-rotate(199deg) brightness(95%) contrast(93%);

                    &.active {
                        filter: invert(18%) sepia(1%) saturate(0%) hue-rotate(43deg) brightness(100%) contrast(92%);
                    }
                }
            }
        }

        .form {
            height: 474px;
            padding: 20px 40px;
            background-color: #4b55c1;
            display: flex;
            justify-content: center;
            flex-direction: column;

            & > h1 {
                font-weight: normal;
                font-size: 22px;
                color: whitesmoke;
                text-align: center;
                font-family: monospace;
            }

            .checks {
                display: grid;
                grid-template-columns: 90px 90px;
                justify-content: space-evenly;

                .check {
                    cursor: pointer;
                    height: 40px;
                    line-height: 40px;
                    text-align: center;
                    border: 1px solid #3a44a8;
                    border-radius: 4px;
                    color: white;

                    input {
                        margin-right: 5px;
                    }

                    &.checked {
                        border-color: #3a44a8;
                        background-color: #3a44a8;
                    }
                }
            }

            & > input, & > select {
                width: 100%;
                height: 50px;
                background-color: #3a44a8;
                border: none;
                border-radius: 4px;
                display: block;
                margin: 15px 0;
                color: whitesmoke;
                font-size: 16px;
                font-family: cursive;
                padding: 0 10px;

                &:focus {
                    outline: none;
                }
            }

            select {
                cursor: pointer;
            }

            button {
                cursor: pointer;
                background-color: #648dec;
                border: none;
                width: 100%;
                height: 50px;
                border-radius: 10px;
                color: white;
                font-size: 22px;
                font-family: sans-serif;
            }
        }
    }
}
</style>
