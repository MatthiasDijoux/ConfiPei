<template>
  <v-card class="mx-auto" outlined>
    <v-list-item three-line>
      <v-list-item-content :item="producer">
        <v-list-item-title class="headline mb-1">{{producer.username}}</v-list-item-title>
        <v-list-item-action-text>{{producer.mail}}</v-list-item-action-text>
      </v-list-item-content>
    </v-list-item>
  </v-card>
</template>
<script src="./producerProfile.js"/>