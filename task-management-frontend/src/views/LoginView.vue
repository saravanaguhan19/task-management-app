<template>
  <nav
    v-if="!isAuthPage"
    class="bg-indigo-600 p-4 rounded-lg shadow-lg flex justify-between items-center"
  >
    <!-- Left side navigation links -->
    <div class="flex space-x-4">
      <RouterLink
        to="/login"
        class="text-white font-semibold hover:bg-indigo-700 px-4 py-2 rounded-md transition-colors duration-200"
      >
        Login
      </RouterLink>
      <RouterLink
        to="/dashboard"
        class="text-white font-semibold hover:bg-indigo-700 px-4 py-2 rounded-md transition-colors duration-200"
      >
        Dashboard
      </RouterLink>
      <RouterLink
        to="/signup"
        class="text-white font-semibold hover:bg-indigo-700 px-4 py-2 rounded-md transition-colors duration-200"
      >
        Signup
      </RouterLink>
    </div>

    <!-- Right side Logout Button -->
    <div>
      <button
        v-on:click="handleLogout"
        class="bg-red-500 text-white font-semibold hover:bg-red-600 px-4 py-2 rounded-md transition-colors duration-200"
      >
        Logout
      </button>
    </div>
  </nav>
</template>

<script>
export default {
  computed: {
    // Check if the current route is login or signup
    isAuthPage() {
      const path = this.$route.path;
      return path === "/login" || path === "/signup"; // Return true if we are on login or signup
    },
  },
  methods: {
    handleLogout() {
      this.$store.dispatch("logout");
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
/* Add custom styles if necessary */
</style>
