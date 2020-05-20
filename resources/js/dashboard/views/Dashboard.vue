<template>
  <v-data-table :headers="headers" :items="products" class="elevation-1" :items-per-page="5">
    <template v-slot:top>
      <v-toolbar flat color="white">
        <v-spacer></v-spacer>
        <!-- dialogProduct -->
        <dialogProduct @addProduct="products.push($event)" />
      </v-toolbar>
    </template>
    <template v-slot:item.produit="{ item }">{{item.name}},</template>
    <template v-slot:item.producteur="{ item }">{{item.producer.name}}</template>
    <template v-slot:item.fruits="{ item }">{{displayFruits(item.fruits)}}</template>
    <template v-slot:item.prix="{ item }">{{item.prix}}</template>
    <template v-slot:item.actions="{ item }">
      <dialogProduct :product="item" :isModification="true" />
    </template>
    <template v-slot:item.image="{ item }">
      <v-img :src="'/storage/images/'+item.image" aspect-ratio="1.9"></v-img>
    </template>
  </v-data-table>
</template>
<script src="./Dashboard.js"/>
