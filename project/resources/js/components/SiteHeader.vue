<template lang="pug">
header
    router-link(:to="{name: 'todo'}") todo
    router-link(:to="{name: 'imageUpload'}") image upload
    router-link(:to="{name: 'meet'}") meet
</template>

<script>
export default {
    name: "Header"
}
</script>

<style lang="scss" scoped>
header {
    display: flex;
    justify-content: center;

    a {
        color: white;
        padding: 5px 10px;
    }
}
</style>
