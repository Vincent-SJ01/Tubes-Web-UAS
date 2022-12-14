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
                    path: "/RegisterUser",
                    name: "Beranda.RegisterUser",
                    component: importComponent("RegisterUser"),
                    
                    //import komponen ke register User
        },
        {
             path: "/RegisterKurir",
             name: "Beranda.RegisterKurir",
             component: importComponent("RegisterKurir"),
        },
        {
            path: "/login",
            name: "Login",
            component: importComponent("LoginPage"),
        },

        {
            path: "/",
            name: "BerandaHome",
            component: importComponent("BerandaHome"), 

             
            

            //nanti import ke beranda
            // component: importComponent("MenuHome/Home"),

            children : [
                // {
                //     path: "/Login",
                //     name: "Beranda.Login",
                //     component: importComponent("LoginPage"),
                
                //     //import componnt milik login
                // },

                // {
                //     path: "/RegisterKurir",
                //     name: "Beranda.RegisterKurir",
                //     component: importComponent("registerKurir"),
                // }, 

                
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