<template lang="pug">
    v-app-bar(elevation="4" fixed)
        v-spacer
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
        // fab
        v-btn(
            color="primary"
            small
            @click="logOut"
        )
            v-icon(left) mdi-cart

        v-btn(
            tile
            color="primary"
            rounded
            @click="logOut"
            v-if="this.$store.state.isLogged"
        )
            v-icon(left) mdi-arrow-right-bold-box
            | logOut

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
            this.$store.commit("changeLang", lang)
        },
        logOut() {
            localStorage.removeItem("user");
            this.$store.state.isLogged = false
        }
    }
}
</script>

<style lang="scss" scoped>
</style>
