<template>
  <v-col cols="12" sm="6" md="12">
    <v-text-field
      type="number"
      v-model="quantity"
      min="0"
      :max="product.quantite"
      label="Quantité"
      filled
      dense
      required
      :hint="product.quantite<5 ? 'Quantité restante: '+product.quantite : ''"
      :persistent-hint="product.quantite<5"
      :disabled="product.quantite==0"
      :error-messages="product.quantite== 0 ? 'Stock épuisé' : ''"
    ></v-text-field>
    <v-btn :disabled="quantity==0" @click="add">
      <v-icon>mdi-plus</v-icon>
    </v-btn>
  </v-col>
</template>
<script src="./addToBasket.js"/>