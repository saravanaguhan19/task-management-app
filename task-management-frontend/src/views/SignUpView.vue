<template>
  <div class="max-w-md mx-auto mt-12 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-6">User Registration</h2>

    <form @submit.prevent="registerUser">
      <!-- Name Input -->
      <div class="mb-4">
        <input
          type="text"
          v-model="user.name"
          id="name"
          required
          placeholder="Name"
          class="mt-1 px-4 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
        />
      </div>

      <!-- Email Input -->
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

      <!-- Password Input -->
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

      <!-- Submit Button -->
      <div class="mb-4">
        <button
          type="submit"
          :disabled="loading"
          class="w-full py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 disabled:opacity-50"
        >
          Register
        </button>
      </div>

      <!-- Success or Error Message -->
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
        name: "",
        email: "",
        password: "",
      },
      loading: false,
      message: "",
      status: true,
    };
  },
  methods: {
    async registerUser() {
      try {
        this.loading = true;
        this.message = "";

        const payload = {
          name: this.user.name,
          email: this.user.email,
          password: this.user.password,
        };

        await this.$store.dispatch("register", payload);
        // try {
        //   // Send API request to register user
        //   const response = await this.$http.post(
        //     "http://127.0.0.1:8000/api/register",
        //     payload
        //   );
        //   if (response.data.status) {
        //     // Store token in local storage
        //     localStorage.setItem("token", response.data.data.token);

        //     this.message = response.data.message;
        //     this.status = true;
        //     this.$router.push("/dashboard");
        //   } else {
        //     this.message = response.data.message;
        //     this.status = false;
        //   }
        // } catch (error) {
        //   // Handle API errors
        //   this.message = "Something went wrong. Please try again.";
        //   this.status = false;
        // } finally {
        //   this.loading = false;
        // }

        this.$router.push("/login");
      } catch (error) {
        this.errors.general = error.message;
      }
    },
  },
};
</script>

<style scoped>
/* You can add custom styles here if needed */
</style>
