<template lang="pug">
v-app-bar(elevation="4" fixed)
    v-tabs(align-with-title)
        v-tab(:to="{name: 'home'}") {{ $t("home") }}
        v-tab(:to="{name: 'admin'}") todo
        v-tab(:to="{name: 'imageUpload'}") image upload
        v-tab(:to="{name: 'meet'}") meet
    v-switch(
        v-model="$vuetify.theme.dark"
        color="secondary"
        hide-details )

    v-select(
        v-model="activeLang"
        :items="langs"
        item-value="value"
        style="max-width: 152px"
        :menu-props="{dark: true}"
        @change="langChanged"
    )
        template(v-slot:selection="{ item }")
            v-img(:src="langImage(item.value)" max-width="20px" max-height="15px" class="mr-1")
            span {{ item.text }}
        template(v-slot:item="{item}")
            v-img(:src="langImage(item.value)" max-width="20px" max-height="15px" class="mr-1")
            span {{ item.text}}

</template>

<script>
export default {
    name: "Header",
    data() {
        return {
            dark: true,
            langs: [
                {
                    value: 'en',
                    text: 'English'
                },
                {
                    value: 'ka',
                    text: 'ქართული'
                }
            ],
            activeLang: 'ka'
        }
    },
    methods: {
        langImage(lang) {
            return `/icons/${lang}.svg`
        },
        langChanged(lang) {
            this.$store.commit("changeLang",lang)
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
