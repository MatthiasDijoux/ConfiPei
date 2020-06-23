<template>
  <v-app>
    <link
      href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css"
      rel="stylesheet"
    />
    <v-container>
      <Navbar></Navbar>
    </v-container>
    <v-content>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-content>
    <Footer />
    <snackbar />
  </v-app>
</template>

<script>
import Navbar from "../navigation/Navbar";
import Footer from "../navigation/Footer";
import Snackbar from "../views/components/Snackbar.vue";

export default {
  components: {
    Footer,
    Navbar,
    Snackbar
  }
};
</script>