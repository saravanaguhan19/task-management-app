import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const router = new VueRouter({
  mode: "history",
  base: import.meta.env.BASE_URL,
  routes: [
    {
      path: "/login",
      name: "login",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/LoginView.vue"),
      meta: {
        isAuth: true,
      },
    },
    {
      path: "/signup",
      name: "signup",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/SignUpView.vue"),
      meta: {
        isAuth: true,
      },
    },
    {
      path: "/dashboard",
      name: "dashboard",
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import("../views/DashboardView.vue"),
      meta: {
        isAuth: false,
      },
    },
  ],
});

// router.beforeEach((to, from, next) => {
//   if (to.matched.some((record) => record.meta.isAuth)) {
//     let token = localStorage.getItem("token");
//     if (!token) {
//       next("/login");
//     }
//   }
//   next();
// });

export default router;
