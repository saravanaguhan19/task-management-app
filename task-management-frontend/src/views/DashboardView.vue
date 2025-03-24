<template>
  <div class="p-4">
    <h2 class="text-2xl font-semibold mb-4">Hello from Dashboard</h2>

    <!-- Shimmer Loading State -->
    <div v-if="loading" class="space-y-4">
      <div class="bg-gray-300 animate-pulse h-6 rounded w-3/4"></div>
      <div class="bg-gray-300 animate-pulse h-6 rounded w-2/3"></div>
      <div class="bg-gray-300 animate-pulse h-6 rounded w-5/6"></div>
    </div>

    <!-- Task List -->
    <ul v-if="tasks && tasks.length && !loading" class="space-y-4">
      <li
        v-for="task of tasks"
        :key="task.id"
        class="border p-4 rounded-lg shadow-md"
      >
        <div class="flex justify-between">
          <span class="text-xl font-bold">{{ task.title }}</span>
          <span class="text-gray-600 text-sm">{{
            task.created_at | formatDate
          }}</span>
        </div>
        <p class="mt-2 text-gray-700">{{ task.description }}</p>
      </li>
    </ul>

    <!-- No Tasks Found -->
    <p v-else-if="!loading" class="text-center text-gray-500">
      No tasks available.
    </p>

    <!-- Error Message -->
    <p v-if="errorMessage" class="text-red-500 text-center mt-4">
      {{ errorMessage }}
    </p>
  </div>
</template>

<script>
// Import any date formatting utility you want
import { format } from "date-fns";

export default {
  data() {
    return {
      tasks: [],
      loading: true,
      errorMessage: null,
    };
  },

  async created() {
    try {
      const response = await this.axios.get("http://127.0.0.1:8000/api/tasks", {
        headers: {
          Authorization: `Bearer ${localStorage.getItem("token")}`,
        },
      });

      if (response.data.status) {
        this.tasks = response.data.data;
      } else {
        this.errorMessage = "Failed to load tasks. Please try again later.";
      }
    } catch (error) {
      this.errorMessage = "Something went wrong. Please try again.";
    } finally {
      this.loading = false;
    }
  },

  filters: {
    formatDate(value) {
      if (!value) return "";
      return format(new Date(value), "MMMM dd, yyyy");
    },
  },
};
</script>

<style scoped>
/* Add any additional styles here if necessary */
</style>
