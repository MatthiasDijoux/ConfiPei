<template>

  <v-toolbar>
    <span class="hidden-sm-and-up"></span>
    <v-toolbar-title>
      <h1>CONFIPEI</h1>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    <v-toolbar-items class="hidden-xs-only">
      <v-btn to="/">Home</v-btn>
      <v-btn to="/dashboard">Dashboard</v-btn>
      <v-btn to="/dashboardProducteur">Profil Producteur</v-btn>
      <v-btn to="/producerManagement">Gestion</v-btn>
      <v-btn to="/confitures">Liste Confitures</v-btn>
      <v-btn to="/Profil">Profil</v-btn>
      <basket />

      <v-btn @click="logout()">deconnexion</v-btn>
    </v-toolbar-items>
  </v-toolbar>
</template>
<script>
import { authenticationService } from "../_services/authentication.service";
import router from "../Router";
import basket from "../views/components/basket.vue";
export default {
  components: {
    basket
  },
  methods: {
    logout() {
      authenticationService.logout();
      router.push("/login");
    }
  }
};
</script>
