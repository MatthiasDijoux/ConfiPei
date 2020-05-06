<template>
    <v-data-table :headers="headers" :items="products" class="elevation-1" :items-per-page="50">
      <template v-slot:top>
        
        <v-toolbar flat color="white">
          <v-spacer></v-spacer>
          <addProduct v-on:addProduct="products.push($event)"/>
        </v-toolbar>
      </template>
      <template v-slot:item.produit="{ item }">{{item.name}},</template>
      <template v-slot:item.producteur="{ item }">{{item.id_producer.name}},</template>
      <template v-slot:item.fruits="{ item }">{{displayFruits(item.fruits)}}</template>
      <template v-slot:item.prix="{ item }">{{item.prix}}</template>
    </v-data-table>
</template>
<script src="./Dashboard.js"/>
