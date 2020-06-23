<template>
  <v-data-table :headers="headers" :items="producers" class="elevation-1" :items-per-page="5">
    <template v-slot:top>
      <v-toolbar flat color="white">producteur</v-toolbar>
      <drawerProducer @update="producers.push($event)" />
    </template>
    <template v-slot:item.nom="{ item }">{{item.name}},</template>
    <template v-slot:item.username="{ item }">{{item.id_user.username}}</template>
    <template v-slot:item.mail="{ item }">{{item.id_user.mail}}</template>
    <template v-slot:item.actions="{ item }">
      <drawerProducer :producer="item" @update="Object.assign(item,$event)"  :isModification="true" />
    </template>
  </v-data-table>
</template>
<script src="./producerManagement.js"/>