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
import AdminListeTacheIndex from "@/views/admin/listeTache/ListeTacheIndex.vue"
import AdminListeTacheEdit from "@/views/admin/listeTache/ListeTacheEdit.vue"
import AdminTacheNew from "@/views/admin/tache/TacheNew.vue"
import AdminListeTacheNew from "@/views/admin/listeTache/ListeTacheNew.vue"
import AdminListeTacheShow from "@/views/admin/listeTache/ListeTacheShow.vue"
import DashboardTache from "@/views/dashboard/DashboardTache.vue";
import DashboardTacheEdit from "@/views/dashboard/tache/TacheEdit.vue"
import DashboardTacheNew from "@/views/dashboard/tache/TacheNew.vue"
import DashboardListeTacheIndex from "@/views/dashboard/listeTache/ListeTacheIndex.vue"
import DashboardListeTacheEdit from "@/views/dashboard/listeTache/ListeTacheEdit.vue"
import DashboardListeTacheShow from "@/views/dashboard/listeTache/ListeTacheShow.vue"
import DashboardListeTacheNew from "@/views/dashboard/listeTache/ListeTacheNew.vue"
import DashboardTacheAffect from "@/views/dashboard/tache/TacheAffecter.vue"
import ObservateurLayout from "@/views/observateur/ObservateurLayout.vue";
import ObservateurHome from "@/views/observateur/ObservateurHome.vue";
import {authObservateur} from "@/_helpers/auth-observateur";
import ObservateurTacheIndex from "@/views/observateur/tache/ObservateurTacheIndex.vue";
import observateurTacheIndex from "@/views/observateur/tache/ObservateurTacheIndex.vue";
import ObservateurListeTache from "@/views/observateur/ObservateurListeTache.vue";

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
        { path: '', name: 'dashboardhome', component: DashboardHome},
        { path: 'taches', name: 'dashboardTache',component: DashboardTache},
        { path: 'tache/edit/:id(\\d+)', name: 'dashboardTacheEdit', component: DashboardTacheEdit,props: true},
        { path: 'tache/new' , name: 'dashboardTacheNew' ,component: DashboardTacheNew},
        { path: 'listeTache' ,name:'dashboardListeTache' , component: DashboardListeTacheIndex},
        { path: 'listeTache/edit/:id(\\d+)' , name: 'dashboardListeTacheEdit', component: DashboardListeTacheEdit,props: true},
        { path: 'listeTache/tache/show/:id(\\d+)',name: 'dashboardListeTacheShow', component: DashboardListeTacheShow,props: true},
        { path: 'listeTache/new' , name: 'dashboardListeTacheNew' , component: DashboardListeTacheNew},
        { path: 'tache/affect',name:'dashboardTacheAffect' , component: DashboardTacheAffect},
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
        { path: 'tache/edit/:id(\\d+)' , name:'AdminTacheEdit', component: AdminTacheEdit, props: true},
        { path: 'tache/new', name: 'AdminTacheNew', component: AdminTacheNew},
        { path: 'liste-taches/tache/:id(\\d+)', name: 'AdminListeTacheShow' ,component: AdminListeTacheShow,props:true},
        { path: 'liste-taches', name: 'AdminListeTacheIndex', component: AdminListeTacheIndex},
        { path: 'liste-taches/edit/:id(\\d+)', name:'AdminListeTacheEdit',component: AdminListeTacheEdit, props:true},
        { path: 'liste-taches/new', name: 'AdminListeTacheNew' , component: AdminListeTacheNew}
      ]
    },
    {
      path: '/observateur',
      name:'Observateur',
      component: ObservateurLayout,
      children:[
        {path: '',name: 'observateurHome',component: ObservateurHome},
        {path: 'taches',name: 'observateurTacheIndex' ,component: observateurTacheIndex},
        {path: 'listetache',name: 'observateurListeTache',component: ObservateurListeTache},

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
  if (to.matched[0].name==="observateur")
  {
    authObservateur()
  }
  next()
})
export default router
