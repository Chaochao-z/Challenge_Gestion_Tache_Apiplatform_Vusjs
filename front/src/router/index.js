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

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: PublicLayout,
      children: [
        { path: '/', name: 'home', component: HomeView}
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
        { path: 'user/edit/:id(\\d+)' , name: 'useredit', component: userEdit, props: true}

      ]
    },
    {
      path: '/login',
      name: 'login',
      component: () => import("../views/auth/Login.vue")
    },
    {
      path:'/:pathMatch(.*)*',component:NotFound
    }

  ]
})

router.beforeEach((to, from, next) =>{
  console.log(to.matched)
  if (to.matched[0].name == "Admin")
  {
    authGuard()
  }
  next()
})
export default router
