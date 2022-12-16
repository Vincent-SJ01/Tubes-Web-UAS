<template>
    <div>
        <v-app-bar
            absolute 
            dark
            :src='require("../assets/App-barBackground.jpg")'
            app
        >

            <template v-slot:img="{ props }">
                <v-img
                    v-bind="props"
                    gradient="to top right, rgba(251, 35, 35,.7), rgba(252, 95, 95,.7)"
                ></v-img>
            </template>

            <v-app-bar-nav-icon></v-app-bar-nav-icon>

            <v-toolbar-title class="text-no-wrap">
                Ngurir
            </v-toolbar-title>

            <v-spacer></v-spacer>

            <template v-slot:extension>
                <v-tabs align-with-title>
                    
                    <v-tab
                        v-for="item in menuItem"
                        :key="item.title"
                        tag="router-link"
                        :to="{name : item.name}"
                    >
                        {{ item.title }}
                    </v-tab>


                </v-tabs>
            </template>

        </v-app-bar>

        <v-main>
            <v-container fluid class="pa-0">
                
                <router-view></router-view>
    
            </v-container>
        </v-main>

        
        



    </div>
    

    
</template>

<script>
export default {
    name: "BerandaHome",

    data() {
        return {
            menuItem : [
                {
                    title: "Home",
                    name: "Beranda"
                },
                {
                    title: "Login",
                    name: "Beranda.Login"
                },
                {
                    title: "Register Kurir",
                    name: "Beranda.RegisterKurir"
                },
                {
                    title: "Register User",
                    name: "Beranda.RegisterUser"
                }


            
            ]


        };
    },
};
</script>

<style scoped>
nav {
    background-color: #18191b;
}

a.router-link-exact-active {
    color: white !important;
}


button {
    font-size: 14px;
}

</style>