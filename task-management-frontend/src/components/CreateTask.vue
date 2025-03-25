<template>
  <div>
    <h1>Create task</h1>
    <input type="text" placeholder="title" v-model="taskTitle" />
    <input type="text" placeholder="description" v-model="taskDescription" />
    <button v-on:click="handleAddTask">Add Task</button>
  </div>
</template>
<script>
export default {
  data() {
    return {
      taskTitle: "",
      taskDescription: "",
    };
  },
  name: "CreateTask",

  methods: {
    async handleAddTask() {
      const taskData = {
        title: this.taskTitle,
        description: this.taskDescription,
      };

      await this.$store.dispatch("createTask", taskData);
    },
  },
};
</script>
