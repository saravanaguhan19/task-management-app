<template>
  <div>
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
