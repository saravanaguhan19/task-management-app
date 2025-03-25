<template>
  <div>
    <div id="app">
      <!-- <nav>
        <RouterLink to="/login">login</RouterLink>
        <RouterLink to="/dashboard">Dashboard</RouterLink>
        <button v-on:click="handleLogout">Logout</button>
      </nav> -->
      <NavComponent />
      <router-view />
    </div>
  </div>
</template>
<script>
import NavComponent from "./components/NavComponent.vue";
export default {
  components: {
    NavComponent,
  },
};
</script>
<style scoped></style>
