import Vue from "vue";
import VueRouter from "vue-router";


Vue.use(VueRouter);

function importComponent(path){
    return () => import(`./components/${path}.vue`);
}


const router = new VueRouter({
    mode : "history",
    routes: [

        {
            path: "/",
            name: "Beranda",

            //nanti import ke beranda
            // component: importComponent("MenuHome/Home"),

            children : [
                {
                    path: "/Login",
                    name: "Beranda.Login",
                
                    //import componnt milik login
                },

                {
                    path: "/RegisterKurir",
                    name: "Beranda.RegisterKurir",

                    //import component milik register
                }, 

                {
                    path: "/RegisterUser",
                    name: "Beranda.RegisterUser",
                    
                    //import komponen ke register User
                }
            ]
        },     


        {
            path: "/admin",
            name: "Admin",
            component: importComponent("MenuAdmin/DashboardAdmin"),

            children : [
                {
                    path: "/admin",
                    name: "Admin.Home",

                    component: importComponent("MenuAdmin/HomeAdmin"),
                },

                {
                    path: "/admin/PageDropPoint",
                    name: "Admin.DropPoint",

                    component: importComponent("MenuAdmin/PageDropPoint"),
                },

                {
                    path: "/admin/PageKota",
                    name: "Admin.Kota",

                    component: importComponent("MenuAdmin/PageKota"),
                },

                {
                    path: "/admin/PageKurir",
                    name: "Admin.Kurir",

                    component: importComponent("MenuAdmin/PageKurir"),
                },

                {
                    path: "/admin/PagePaket",
                    name: "Admin.Paket",

                    component: importComponent("MenuAdmin/PagePaket"),
                }

            ],
                

                
            
            

        }
    ]
})


export default router;