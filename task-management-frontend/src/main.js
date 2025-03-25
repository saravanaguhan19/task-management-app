import Vue from "vue";

import App from "./App.vue";
import router from "./router";
import axios from "axios";
import VueAxios from "vue-axios";
import "./assets/styles/tailwind.css";
import store from "./store/store";

import "./assets/main.css";

new Vue({
  store,
  router,
  render: (h) => h(App),
}).$mount("#app");

Vue.use(VueAxios, axios);

// You can set the base URL for the API requests globally:
axios.defaults.baseURL = "https://your-api-url.com";
axios.defaults.headers.common["Accept"] = "application/json";
