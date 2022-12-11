import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'LoginAdmin',
    component: () => import('../views/Login.vue')
  },
  {
    path: '/admin',
    name: 'Admin',
    component: () => import('../components/DashboardAdmin.vue'),

    children: [
        {
            path: '',
            name: 'Admin.Home',
            
            component: () => import('../views/MenuAdmin/HomeAdmin.vue')
        },
        {
            path: 'paket',
            name: 'Admin.Paket',

            component: () => import('../views/MenuAdmin/PagePaket.vue')
        }
    ]
  }




  

]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
