<template>
 <v-toolbar>
      <span class="hidden-sm-and-up">
      </span>
      <v-toolbar-title>
          <h1>CONFIPEI</h1>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items class="hidden-xs-only">
          <router-link to="/dashboard" tag="span" style="cursor: pointer">
         Dashboard
        </router-link>
         <router-link to="/" tag="span" style="cursor: pointer">
         Home
        </router-link>
        <v-btn href="/api/logout" @click.native.stop>deconnexion</v-btn>
      </v-toolbar-items>
    </v-toolbar>
</template>