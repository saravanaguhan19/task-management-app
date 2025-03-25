<!-- <template>
  <div class="max-w-md mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

    <form @submit.prevent="loginUser">
  
      <div class="mb-4">
        <input
          type="email"
          v-model="user.email"
          id="email"
          required
          placeholder="Email"
          class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

    
      <div class="mb-4">
        <input
          type="password"
          v-model="user.password"
          id="password"
          required
          placeholder="Password"
          class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      
      <div class="mb-4">
        <button
          type="submit"
          :disabled="loading"
          class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 disabled:opacity-50"
        >
          Login
        </button>
      </div>

      
      <div
        v-if="message"
        :class="{ 'text-green-600': status, 'text-red-600': !status }"
        class="text-center mt-4"
      >
        {{ message }}
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      loading: false,
      message: "",
      status: true,
    };
  },
  methods: {
    async loginUser() {
      this.loading = true;
      this.message = "";

      const payload = {
        email: this.user.email,
        password: this.user.password,
      };

      try {
        // Send API request to register user
        const response = await this.$http.post(
          "http://127.0.0.1:8000/api/login",
          payload
        );

        if (response.data.status) {
          // Store token in local storage
          localStorage.setItem("token", response.data.data.token);

          this.message = response.data.message;
          this.status = true;
          this.$router.push({ name: "dashboard" });
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
  },
};
</script>

<style scoped>
/* You can add custom styles here if needed */
</style> -->

<template>
  <div class="flex h-screen">
    <!-- Image Section -->
    <div class="w-1/2 bg-gray-100 flex items-center justify-center">
      <img
        src="/task-management.jpg"
        alt="Task Management"
        class="max-w-full h-auto"
      />
    </div>

    <!-- Login Form Section -->
    <div
      class="w-1/2 flex flex-col justify-center items-center p-10 bg-white shadow-lg"
    >
      <h2 class="text-3xl font-semibold mb-6">Login</h2>
      <form v-on:submit.prevent="handleLogin" class="w-full max-w-sm">
        <div class="mb-4">
          <label class="block text-gray-700">Email</label>
          <input
            v-model="email"
            type="email"
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
          <span v-if="errors.email" class="text-red-500 text-sm">{{
            errors.email
          }}</span>
        </div>
        <div class="mb-4">
          <label class="block text-gray-700">Password</label>
          <input
            v-model="password"
            type="password"
            required
            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
          />
          <span v-if="errors.password" class="text-red-500 text-sm">{{
            errors.password
          }}</span>
        </div>
        <button
          type="submit"
          class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300"
        >
          Login
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      email: "",
      password: "",
      errors: {},
    };
  },
  methods: {
    ...mapActions(["login"]),
    validateForm() {
      this.errors = {};
      if (!this.email.includes("@")) {
        this.errors.email = "Invalid email format";
      }
      if (this.password.length < 6) {
        this.errors.password = "Password must be at least 6 characters";
      }
      return Object.keys(this.errors).length === 0;
    },
    async handleLogin() {
      if (this.validateForm()) {
        try {
          console.log(this.$store);
          await this.$store.dispatch("login", {
            email: this.email,
            password: this.password,
          });
          this.$router.push("/dashboard");
        } catch (error) {
          this.errors.general = error.message;
        }
      }
    },
  },
};
</script>

<style scoped></style>
