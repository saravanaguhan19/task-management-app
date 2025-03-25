<!-- <template>
  <nav class="">
    <RouterLink to="/login">login</RouterLink>
    <RouterLink to="/dashboard">Dashboard</RouterLink>
    <RouterLink to="/signup">Signup</RouterLink>

    <button v-on:click="handleLogout">Logout</button>
  </nav>
</template>
<script>
export default {
  methods: {
    handleLogout() {
      this.$store.dispatch("logout");
      this.$router.push("/login");
    },
  },
};
</script> -->
<template>
  <nav
    class="bg-slate-400 p-4 rounded-lg shadow-lg flex justify-between items-center"
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
  methods: {
    handleLogout() {
      this.$store.dispatch("logout");
      this.$router.push("/login");
    },
  },
};
</script>

<style scoped>
/* You can add any additional custom styling here if needed */
</style>
