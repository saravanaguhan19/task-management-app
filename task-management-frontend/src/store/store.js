// import Vue from "vue";
// import Vuex from "vuex";
// import axios from "axios";

// Vue.use(Vuex);

// export default new Vuex.Store({
//   state: {
//     user: null,
//     token: localStorage.getItem("token") || "",
//   },
//   mutations: {
//     SET_USER(state, user) {
//       state.user = user;
//     },
//     SET_TOKEN(state, token) {
//       state.token = token;
//       localStorage.setItem("token", token);
//     },
//     LOGOUT(state) {
//       state.user = null;
//       state.token = "";
//       localStorage.removeItem("token");
//     },
//   },
//   actions: {
//     async login({ commit }, credentials) {
//       try {
//         const response = await axios.post("/api/login", credentials);
//         commit("SET_USER", response.data.user);
//         commit("SET_TOKEN", response.data.token);
//       } catch (error) {
//         throw new Error("Invalid login credentials");
//       }
//     },
//     logout({ commit }) {
//       commit("LOGOUT");
//     },
//   },
//   getters: {
//     isAuthenticated: (state) => !!state.token,
//     getUser: (state) => state.user,
//   },
// });

import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

const state = {
  numbers: [],
};

const mutations = {
  ADD_NUMBER(state, payload) {
    state.numbers.push(payload);
  },
};

const actions = {
  addNumber(context, number) {
    context.commit("ADD_NUMBER", number);
  },
};

const getters = {
  getNumbers(state) {
    return state.numbers;
  },
  getString(state) {
    return state.numbers;
  },
};

export default new Vuex.Store({
  state,
  getters,
  mutations,
  actions,
});
