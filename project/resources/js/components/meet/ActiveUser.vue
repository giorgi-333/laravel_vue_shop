<template lang="pug">
.user(:class="{'active': active}")
    img(src="/icon/girl.png")
    .info
        b niako
        i ასაკი: 22
</template>

<script>
export default {
    name: "ActiveUser",
    props: ["active"]
}
</script>

<style lang="scss" scoped>
.user {
    cursor: pointer;
    width: 100%;
    padding: 10px;
    margin-bottom: 3px;
    background-color: #1a4aa4;
    display: flex;

    &.active {
        background-color: #0b2e83;
    }

    img {
        height: 50px;
    }

    .info {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 25px;

        i {
            transform: translateY(15px);
        }
    }
}
</style>
