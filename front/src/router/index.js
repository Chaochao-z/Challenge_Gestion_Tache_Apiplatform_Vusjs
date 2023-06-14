import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/public/HomeView.vue'
import Login from '../views/auth/Login.vue'
import NotFound from '../views/error/NotFound.vue'
import DashboardLayout from "../views/dashboard/DashboardLayout.vue";
import DashboardHome from "../views/dashboard/DashoboardHome.vue";
import PublicLayout from "../views/public/PublicLayout.vue";
import AdminLayout from "../views/admin/AdminLayout.vue";
import AdminHome from "../views/admin/AdminHome.vue";
import UserEdit from "../views/admin/users/UserEdit.vue";
import userEdit from "../views/admin/users/UserEdit.vue";
import {authGuard} from "../_helpers/auth-guard";
import login from "../views/auth/Login.vue";
import {CheckLogged} from "@/services/checkLogged";
import {displayMsg} from "@/utils/toast";
import {authUser} from "@/_helpers/auth-user";
import Register from "@/views/auth/Register.vue";
import AdminUserIndex from "@/views/admin/users/UserIndex.vue"
import VerifyAccount from "@/views/auth/VerifyAccount.vue";
import AdminTacheIndex from "@/views/admin/tache/TacheIndex.vue"
import AdminTacheEdit from "@/views/admin/tache/TacheEdit.vue"


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: PublicLayout,
      children: [
        { path: '', name: 'homeview', component: HomeView}
      ]
    },
    {
      path: '/dashboard',
      name:'dashboardhome',
      component: DashboardLayout,
      children: [
        { path: '', name: 'dashboardhome', component: DashboardHome}
      ]
    },
    {
      path: '/admin',
      name: 'Admin',
      component: AdminLayout,
      children: [
        { path: '' , name: 'adminhome', component: AdminHome },
        { path: 'users', name: 'AdminUsers' , component: AdminUserIndex },
        { path: 'user/edit/:id(\\d+)' , name: 'admin-user', component: userEdit, props: true},
        { path: 'taches', name:'AdminTacheIndex', component:AdminTacheIndex },
        { path: 'tache/edit/:id(\\d+)' , name:'AdminTacheEdit', component: AdminTacheEdit, props: true}
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: () => import("../views/auth/Login.vue"),
      beforeEnter: async(to, from, next) =>{
        if (CheckLogged())
        {
          displayMsg({msg:"Vous étes déjà connecté",type:"error"})
          return next({ name: "home" });
        }

        return next();
      }
    },
    {
      path:'/register',
      name:'register',
      component: Register,
      beforeEnter: async(to, from, next) =>{
        if (CheckLogged())
        {
          displayMsg({msg:"Vous étes déjà connecté",type:"error"})
          return next({ name: "home" });
        }

        return next();
      }
    },
    {
      path: "/verify-account/:token",
      name: "verify-account",
      component:()=>import('../views/auth/VerifyAccount.vue')
    },

    {
      path:'/:pathMatch(.*)*',component:NotFound
    }

  ]
})

router.beforeEach((to, from, next) =>{
  console.log(to.matched)
  if (to.matched[0].name === "Admin")
  {
    authGuard()
  }
  if (to.matched[0].name ==="dashboardhome")
  {
    authUser()
  }
  next()
})
export default router
