<template>
  <div class="about">
    <h1>This is an about page</h1>
    {{ info }}
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      info: "",
    };
  },

  mounted() {
    axios
      .get("https://jsonplaceholder.typicode.com/todos/1")
      .then((response) => (this.info = response.data));
  },
};
</script>
<style>
@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>
