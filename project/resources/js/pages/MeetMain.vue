<template lang="pug">
.cont
    h1 rame
</template>

<script>
export default {
    name: "MeetMain"
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

    .meet {
        max-width: max-content;
        display: grid;
        grid-template-columns: 390px 320px;
        justify-content: center;
        align-items: center;
        box-shadow: 2px 2px 6px rgba(51, 51, 51, 0.63);
        border-radius: 8px;
        overflow: hidden;
    }
}
</style>
