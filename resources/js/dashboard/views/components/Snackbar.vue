<template>
  <v-snackbar  v-model="snackbar" :timeout="timeout" :color="color">
    {{ text }}
    <v-btn text @click="snackbar = false">Close</v-btn>
  </v-snackbar>
</template>
<script>
import EventBus from "../../eventBus.js";
export default {
  data() {
    return {
      snackbar: false,
      text: "",
      color: "purple",
      timeout: 2000
    };
  },
  created() {
    EventBus.$on("snackError", error => {
      this.snackbar = true;
      this.text = error['msg'];
      this.color = "purple";
    });
  }
};
</script>