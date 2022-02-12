<template lang="pug">
.imga
    .chats
        span !
        img(src="/icon/email.png")
</template>

<script>
export default {
    name: "Chats"
}
</script>

<style lang="scss" scoped>
.imga {
    cursor: pointer;
    display: flex;
    align-items: center;
    position: absolute;
    top: 30%;
    right: 0;
    width: 70px;
    background-color: #1a4aa4;
    box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
    border-radius: 30px 0 0 30px;

    .chats {
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

@keyframes rxeva {
    from {
        transform: rotate(-30deg)
    }
    to {
        transform: rotate(20deg) scale(1.2);
    }
}
</style>
