<template>
    <v-app>
        <v-app-bar fixed>
            <v-app-bar-nav-icon @click="drawer = true"></v-app-bar-nav-icon>
            <v-toolbar-title>სამართავი პანელი</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn to="/" exact>
                საიტზე გადასვლა
            </v-btn>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            absolute
            fixed
            temporary
        >
            <v-list
                nav
                dense
            >
                <v-list-item-group
                    v-model="group"
                    active-class="deep-primary--text text--accent-4"
                >
                    <v-list-item :to="{name: 'admin'}" exact>
                        <v-list-item-icon>
                            <v-icon>mdi-home</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>პროდუქტები</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{name: 'orders'}" exact>
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>შეკვეთები</v-list-item-title>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
        <div class="pt-16">
            <router-view></router-view>
        </div>
    </v-app>
</template>

<script>
export default {
    name: "Admin-Webiste",
    data() {
        return {
            drawer: false,
            group: null,
        }
    }
}
</script>

<style scoped>
.v-toolbar {
    flex: unset !important;
}
</style>
