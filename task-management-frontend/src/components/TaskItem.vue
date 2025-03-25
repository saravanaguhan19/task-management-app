<template>
  <li class="border p-4 rounded-lg shadow-md">
    <div class="flex justify-between">
      <span class="text-xl font-bold">{{ task.title }}</span>
      <span class="text-gray-600 text-sm">{{ task.created_at }}</span>
    </div>
    <p class="mt-2 text-gray-700">{{ task.description }}</p>

    <!-- Action Buttons -->
    <div class="mt-4 flex justify-between">
      <button
        @click="toggleStatus"
        class="px-4 py-2 bg-blue-500 text-white rounded"
      >
        Toggle Status
      </button>
      <button
        @click="editTask"
        class="px-4 py-2 bg-yellow-500 text-white rounded"
      >
        Edit
      </button>
      <button
        @click="deleteTask"
        class="px-4 py-2 bg-red-500 text-white rounded"
      >
        Delete
      </button>
    </div>
  </li>
</template>

<script>
export default {
  name: "TaskItem",

  props: {
    task: Object,
  },
  methods: {
    toggleStatus() {
      this.$emit("toggle-status", this.task.id); // Emit an event to toggle status
    },
    editTask() {
      this.$emit("edit-task", this.task.id); // Emit an event to edit the task
    },
    deleteTask() {
      this.$emit("delete-task", this.task.id); // Emit an event to delete the task
    },
  },
  //   filters: {
  //     formatDate(value) {
  //       if (!value) return "";
  //       return this.$parent.formatDate(value); // Using parent filter
  //     },
  //   },
};
</script>
