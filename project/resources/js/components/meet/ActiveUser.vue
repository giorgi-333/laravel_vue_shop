<template lang="pug">
.user(:class="{'active': active, 'mini': mini}"  @click="$emit('changed', id)")
    img(src="/icon/girl.png")
    .info
        b niako
        i ასაკი: 22
    .unread(v-if="mini") წაუკითხავი
</template>

<script>
export default {
    name: "ActiveUser",
    props: ["active","mini","id"],
    methods: {
        er() {
            alert(2)
        }
    }
}
</script>

<style lang="scss" scoped>
.user {
    cursor: pointer;
    width: 100%;
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 3px;
    background-color: #1a4aa4;
    color: white;

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

    &.mini {
        border-radius: 8px;
        background-color: #5b6d97;

        .info {
            padding-left: 15px;

            i {
                display: none;
            }
        }
        .unread {
            color: #50cc0a;
        }
    }
}
</style>
