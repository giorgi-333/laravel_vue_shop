<template lang="pug">
v-app-bar(elevation="4" fixed)
    v-tabs(align-with-title)
        v-tab(:to="{name: 'home'}") Home
        v-tab(:to="{name: 'admin'}") todo
        v-tab(:to="{name: 'imageUpload'}") image upload
        v-tab(:to="{name: 'meet'}") meet
    v-switch(
        v-model="$vuetify.theme.dark"
        color="secondary"
        hide-details )
</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            dark: true
        }
    }
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
