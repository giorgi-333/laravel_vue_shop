<template lang="pug">
.chats-wrapper(:class="{'active': active}")
    .cont
        .icon-wrapper
            .icon(@click="active = !active")
                span !
                img(src="/icon/email.png")
        .chats
            ActiveUser(v-for="i in 10" :key="i" :mini="true")
</template>

<script>
import ActiveUser from "./ActiveUser";
export default {
    name: "Chats",
    components: {
        ActiveUser
    },
    data() {
        return {
            active: false
        }
    }
}
</script>

<style lang="scss" scoped>
.chats-wrapper {
    position: absolute;
    width: 280px;
    height: 100%;
    top: 0;
    right: 0;
    transform: translateX(100%);
    transition: .4s;
    //background-color: #1a4aa4;
    box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
    border-radius: 10px 0 0 10px;
    border: 8px solid #5b6d97;

    &.active {
        transform: translateX(0);
    }

    .cont {
        position: relative;
        height: 100%;

        .icon-wrapper {
            cursor: pointer;
            display: flex;
            align-items: center;
            position: absolute;
            top: 15%;
            left: -8px;
            transform: translateX(-100%);
            width: 70px;
            background-color: #1a4aa4;
            box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
            border-radius: 30px 0 0 30px;

            .icon {
                position: relative;
                display: flex;
                align-items: center;

                span {
                    position: absolute;
                    top: 0;
                    right: -4px;
                    width: 20px;
                    height: 20px;
                    background-color: firebrick;
                    border-radius: 50%;
                    text-align: center;
                    color: white;
                    font-weight: bold;
                    z-index: 99;
                    // animation
                    animation: rxeva .8s linear infinite alternate;
                }

                img {
                    width: 50px;
                    margin-left: 13px;
                    filter: invert(100%) sepia(0%) saturate(2%) hue-rotate(30deg) brightness(111%) contrast(101%);
                }
            }
        }
        .chats {
            height: 100%;
            overflow-y: auto;
            padding: 3px;
        }
    }
}

@keyframes rxeva {
    from {
        transform: rotate(-30deg)
    }
    to {
        transform: rotate(20deg) scale(1.2);
    }
}
</style>
