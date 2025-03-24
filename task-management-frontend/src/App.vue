<script setup></script>

<template>
  <div>
    <div id="app">
      <nav>
        <RouterLink to="/">Go to Home</RouterLink>
        <RouterLink to="/about">Go to About</RouterLink>
        <RouterLink to="/about">Go to About</RouterLink>
        <RouterLink to="/dashboard">Dashboard</RouterLink>
      </nav>

      <router-view />
    </div>
  </div>
</template>

<style scoped></style>
