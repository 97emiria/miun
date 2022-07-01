import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    // meta: {title: 'Home page'},
    component: HomeView
  },


    {
      path: '/login',
      name: 'login',
      component: () => import(/* webpackChunkName: "login" */ '../views/loginView.vue'),
      beforeEnter() {
        if (sessionStorage.getItem("isAuthenticated")  === 'true') {
          window.location.replace("/#/profile");
        }
      }
    },
  {

    path: '/createAccount',
    name: 'createAccount',
    component: () => import(/* webpackChunkName: "createAccount" */ '../views/createAccountView.vue'),
    beforeEnter() {
      if (sessionStorage.getItem("isAuthenticated")  === 'true') {
        window.location.replace("/#/profile");
      }
    }
  },
  {

    path: '/Profile',
    name: 'Profile',
    component: () => import(/* webpackChunkName: "Profile" */ '../views/profileView.vue'),
    beforeEnter() {
      if (sessionStorage.getItem("isAuthenticated") !== 'true') {
        window.location.replace("/#/login");
      }
    }
  },
  {
    path: '/CreateVibbz',
    name: 'CreateVibbz',
    component: () => import(/* webpackChunkName: "CreateVibbz" */ '../views/CreateVibbzView.vue'),
    beforeEnter() {
      if (sessionStorage.getItem("isAuthenticated") !== 'true') {
        window.location.replace("/#/login");
      }
    }
  },
  {
    path: '/:pathMatch(.*)*',
    name: '404',
    component: () => import(/* webpackChunkName: "404" */ '../views/404View.vue'),
  },
  {

    path: '/love',
    name: 'love',
    component: () => import(/* webpackChunkName: "love" */ '../views/loveView.vue')
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
