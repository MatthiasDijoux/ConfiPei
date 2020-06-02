<template>
  <div>
    <v-autocomplete
      v-model="fruits"
      :loading="loading"
      :items="fruitList"
      item-value="name"
      :search-input.sync="search"
      item-text="name"
      multiple
      cache-items
      hide-no-data
      hide-details
      placeholder="Fruits*"
      label="Fruit"
      @change="filterFruit"
    >
      <template v-slot:prepend>
        <v-btn icon color="success" :disabled="fruits.length == 0">
          <v-icon>mdi-plus-circle</v-icon>
        </v-btn>
      </template>
    </v-autocomplete>
    <v-row>
      <v-col class="md-4" v-for="(product,key) in productsDisplay" :key="key">
        <v-card class="mx-auto" max-width="344">
          <v-img :src="'/storage/images/'+product.image" height="200px"></v-img>

          <v-card-title>{{product.name}}</v-card-title>

          <v-card-subtitle>
            Fruits: {{displayFruits(product.fruits)}}
            <v-spacer/>
            <addToBasket :product="product"/>
          </v-card-subtitle>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>
<script src="./Product.js"/>