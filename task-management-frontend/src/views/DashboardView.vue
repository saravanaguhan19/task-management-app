<template>
  <div class="p-4">
    <h2 class="text-2xl font-semibold mb-4">Hello from Dashboard</h2>

    <CreateTask />
    <!-- Shimmer Loading State -->
    <div v-if="loading" class="space-y-4">
      <div class="bg-gray-300 animate-pulse h-6 rounded w-3/4"></div>
      <div class="bg-gray-300 animate-pulse h-6 rounded w-2/3"></div>
      <div class="bg-gray-300 animate-pulse h-6 rounded w-5/6"></div>
    </div>

    <!-- Task List -->

    <ul v-if="tasks && tasks.length" class="space-y-4">
      <TaskItem
        v-for="task of tasks"
        :key="task.id"
        class="border p-4 rounded-lg shadow-md"
        :task="task"
      />
      <!-- </li> -->
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
import TaskItem from "../components/TaskItem.vue";
import CreateTask from "../components/CreateTask.vue";
export default {
  data() {
    return {
      tasks: [],
      loading: true,
      errorMessage: null,
    };
  },
  computed: {
    // getTasks() {
    //   return this.$store.getters.tasks;
    // },
  },
  components: {
    TaskItem,
    CreateTask,
  },

  async created() {
    await this.$store.dispatch("fetchTasks");
    this.tasks = this.$store.getters.toDoTasks;

    if (this.tasks) this.loading = false;

    console.log(this.tasks, "this.tasks");
  },
};
</script>

<style scoped>
/* Add any additional styles here if necessary */
</style>
