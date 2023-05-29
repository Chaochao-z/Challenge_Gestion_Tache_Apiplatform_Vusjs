import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/public/HomeView.vue'
import Login from '../views/auth/Login.vue'
import NotFound from '../views/error/NotFound.vue'
import DashboardLayout from "../views/dashboard/DashboardLayout.vue";
import DashboardHome from "../views/dashboard/DashoboardHome.vue";
import PublicLayout from "../views/public/PublicLayout.vue";

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
        { path: '/dashboard', name: 'dashboardhome', component: DashboardHome}
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path:'/:pathMatch(.*)*',component:NotFound
    }

  ]
})

export default router
