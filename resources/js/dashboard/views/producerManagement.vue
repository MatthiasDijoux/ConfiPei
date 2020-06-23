<template>
  <v-data-table :headers="headers" :items="producers" class="elevation-1" :items-per-page="5">
    <template v-slot:top>
      <v-toolbar flat color="white">producteur</v-toolbar>
    </template>
    <template v-slot:item.produit="{ item }">{{item.name}},</template>
    <template v-slot:item.producteur="{ item }">{{item.producer.name}}</template>
    <template v-slot:item.fruits="{ item }">{{displayFruits(item.fruits)}}</template>
    <template v-slot:item.prix="{ item }">{{item.prix}}</template>
  </v-data-table>
</template>
<script src="./productsTable.js"/>

</template>

<script src="./producerManagement.js"/>