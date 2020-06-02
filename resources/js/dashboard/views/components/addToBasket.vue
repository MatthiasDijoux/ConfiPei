<template>
  <v-col cols="12" sm="6" md="12">
    <v-text-field type="number" v-model="quantity" min="0" label="Quantité" filled dense required></v-text-field>
    <v-btn :disabled='quantity==0'  @click="add">
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </v-col>
</template>
<script src="./addToBasket.js"/>