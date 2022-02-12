<template lang="pug">
.wrapper
   .cont
       .left
           .head
               span ონლაინში მყოფი
               b 1199
           .actives
               ActiveUser(v-for="i in 14" :key="i" :active="i === 4")
       .right
           .head contacti.ge
           .mes
               .imga
                  Chats
               h1
                  div
                      img(src="/icon/girl.png")
                      span niako
                          i 22 წლის
                  img(src="/icon/block.png")
           .sends
               textarea
               img(src="/icon/send.png")
</template>

<script>
import ActiveUser from "../components/meet/ActiveUser";
import Chats from "../components/meet/Chats";

export default {
    name: "MeetMain",
    components: {
        ActiveUser,
        Chats
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');
.wrapper {
    position: relative;
    width: 100%;
    padding: 30px;
    height: 100vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #4b55c1;

    .cont {
        max-width: 1300px;
        width: 100%;
        height: 80vh;
        display: grid;
        grid-template-columns: 290px 1fr;
        justify-content: center;
        align-items: center;
        box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
        border-radius: 8px;
        overflow: hidden;

        .left {
            height: 100%;
            background-color: #0a2a77;
            color: whitesmoke;

            .head {
                padding: 20px 8px;
                background-color: #0b2e83;
                font-size: 22px;
                text-align: center;

                b {
                    font-size: 20px;
                    display: inline-block;
                    min-width: 35px;
                    height: 35px;
                    padding: 0 5px;
                    line-height: 35px;
                    margin-left: 5px;
                    text-align: center;
                    background-color: #fff;
                    color: #0b2e83;
                    border-radius: 15px;
                    font-family: monospace;
                }
            }

            .actives {
                height: calc(80vh - 75px);
                overflow-y: auto;
            }
        }
        .right {
            height: 100%;
            display: grid;
            grid-template-rows: max-content 1fr max-content;

            .head {
                cursor: pointer;
                height: 76px;
                line-height: 76px;
                padding: 0 28px;
                background-color: #1a4aa4;
                font-size: 28px;
                font-family: 'Courgette', cursive;
                text-align: center;
                color: #fff;
                box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
            }
            .mes {
                position: relative;
                height: 100%;
                background-color: #fff;

                h1 {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    cursor: pointer;
                    font-family: cursive;
                    background-color: #0b2e83;
                    box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
                    font-size: 28px;
                    color: white;
                    padding: 5px 15px;
                    border-radius: 8px;
                    margin: 1px;

                    & > div {
                        display: flex;
                        align-items: center;

                        img {
                            width: 40px;
                        }

                        span {
                            i {
                                font-family: 'Courgette', cursive;
                                margin-left: 5px;
                                font-size: 16px;
                            }
                        }
                    }

                    & > img {
                        width: 30px;
                    }
                }
            }
            .sends {
                background-color: #dde7fd;
                height: 76px;
                padding: 10px 20px;
                display: flex;
                align-items: center;

                textarea {
                    width: 80%;
                    height: 100%;
                    padding: 5px;
                    resize: none;
                    border-radius: 4px;
                    //border: 1px solid #333;

                    &:focus {
                        outline: none;
                    }
                }

                img {
                    cursor: pointer;
                    width: 40px;
                    margin-left: 90px;
                }
            }
        }
    }
}
</style>
