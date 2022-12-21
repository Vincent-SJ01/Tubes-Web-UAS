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
            component: importComponent("BerandaHome"), 

            children : [

                {
                    path: "/login",
                    name: "Beranda.Login",
                    component: importComponent("LoginPage"),
                },

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
                    path: "/NotVerified",
                    name: "NotVerified",
        
                    component: importComponent("NotVerified"),
                }
            
            ]
        },

        

        
        {
            path: "/user",
            name: "User",

            component: importComponent("MenuUser/DashboardUser"),

            children: [
                {
                    path: "/user/PagePaket",
                    name: "User.Paket",

                    component: importComponent("MenuUser/PagePaket"),
                }, 

                {
                    path: "/user/Profile",
                    name: "User.Profile",

                    component: importComponent("MenuUser/Profile"),
                }
            ]
        },


        {
            path: "/kurir",
            name: "Kurir",

            component: importComponent("MenuKurir/DashboardKurir"),

            children: [
                {
                    path: "/kurir/PagePengantaran",
                    name: "Kurir.Pengantaran",

                    component: importComponent("MenuKurir/PagePengantaran"),
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