import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    token: localStorage.getItem("token") || "",
    toDoTasks: [],
    loading: false,
    errorMessage: null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_TOKEN(state, token) {
      state.token = token;
      localStorage.setItem("token", token);
    },
    LOGOUT(state) {
      state.user = null;
      state.token = "";
      localStorage.removeItem("token");
    },
    //Task
    SET_TASKS(state, toDoTasks) {
      state.toDoTasks = toDoTasks;
    },
    ADD_TASK(state, task) {
      state.toDoTasks.push(task); // Add new task to the task list
    },
    UPDATE_TASK(state, updatedTask) {
      const index = state.tasks.findIndex((task) => task.id === updatedTask.id);
      if (index !== -1) {
        Vue.set(state.tasks, index, updatedTask); // Update the task in the state
      }
    },
    DELETE_TASK(state, taskId) {
      state.toDoTasks = state.tasks.filter((task) => task.id !== taskId); // Remove task from the list
    },
    SET_LOADING(state, isLoading) {
      state.loading = isLoading;
    },
    SET_ERROR_MESSAGE(state, message) {
      state.errorMessage = message;
    },
  },
  actions: {
    async login({ commit }, credentials) {
      try {
        const response = await axios.post("/api/login", credentials);
        console.log(response.data);
        commit("SET_USER", response.data.data.user);
        commit("SET_TOKEN", response.data.data.token);

        console.log(this.state.user);
      } catch (error) {
        throw new Error("Invalid login credentials");
      }
    },

    async register({ commit }, payload) {
      try {
        const response = await axios.post(
          "http://127.0.0.1:8000/api/register",
          payload
        );
        console.log(response);
        if (response.data.data.status) {
          // Store token in local storage

          commit("SET_USER", response.data.data.user);
          commit("SET_TOKEN", response.data.data.token);

          this.message = response.data.message;
          this.status = true;
        } else {
          this.message = response.data.message;
          this.status = false;
        }
      } catch (error) {
        // Handle API errors
        this.message = "Something went wrong. Please try again.";
        this.status = false;
      } finally {
        this.loading = false;
      }
    },

    logout({ commit }) {
      commit("LOGOUT");
    },
    // Fetch all tasks
    async fetchTasks({ commit }) {
      commit("SET_LOADING", true);
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/tasks", {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });
        if (response.data.status) {
          commit("SET_LOADING", false);
          commit("SET_TASKS", response.data.data); // Assuming the tasks come in the 'data' property
        } else {
          commit("SET_ERROR_MESSAGE", "Failed to load tasks.");
        }
      } catch (error) {
        commit("SET_ERROR_MESSAGE", "Something went wrong.");
      } finally {
        commit("SET_LOADING", false);
      }
    },

    // Create a new task
    async createTask({ commit }, taskData) {
      commit("SET_LOADING", true);
      try {
        const response = await axios.post("/api/tasks", taskData, {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        });
        if (response.data.status) {
          commit("ADD_TASK", response.data.data); // Add the new task to the list
        } else {
          commit("SET_ERROR_MESSAGE", "Failed to create task.");
        }
      } catch (error) {
        commit("SET_ERROR_MESSAGE", "Error creating task.");
      } finally {
        commit("SET_LOADING", false);
      }
    },

    // Update an existing task
    async updateTask({ commit }, taskData) {
      commit("SET_LOADING", true);
      try {
        const response = await axios.put(
          `http://127.0.0.1:8000/api/tasks/${taskData.id}`,
          taskData,
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        );
        if (response.data.status) {
          commit("UPDATE_TASK", response.data.data); // Update the task in the list
        } else {
          commit("SET_ERROR_MESSAGE", "Failed to update task.");
        }
      } catch (error) {
        commit("SET_ERROR_MESSAGE", "Error updating task.");
      } finally {
        commit("SET_LOADING", false);
      }
    },

    // Delete a task
    async deleteTask({ commit }, taskId) {
      commit("SET_LOADING", true);
      try {
        const response = await axios.delete(
          `http://127.0.0.1:8000/api/tasks/${taskId}`,
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        );
        if (response.data.status) {
          commit("DELETE_TASK", taskId); // Remove the deleted task from the list
        } else {
          commit("SET_ERROR_MESSAGE", "Failed to delete task.");
        }
      } catch (error) {
        commit("SET_ERROR_MESSAGE", "Error deleting task.");
      } finally {
        commit("SET_LOADING", false);
      }
    },

    // Toggle task status
    async toggleTaskStatus({ commit, state }, taskId) {
      if (!state.isAuthenticated) {
        commit(
          "setErrorMessage",
          "You must be logged in to toggle task status."
        );
        return;
      }

      try {
        // You may need to make an API request to toggle the status
        // const response = await axios.patch(`http://127.0.0.1:8000/api/tasks/${taskId}/status`, {
        //   headers: {
        //     Authorization: `Bearer ${state.token}`,
        //   },
        // });

        commit("toggleTaskStatus", taskId);
      } catch (error) {
        commit("setErrorMessage", "Failed to toggle task status.");
      }
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
    getUser: (state) => state.user,
    toDoTasks: (state) => state.toDoTasks,
    loading: (state) => state.loading,
    errorMessage: (state) => state.errorMessage,
  },
});
