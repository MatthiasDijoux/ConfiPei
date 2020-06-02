<template>
  <v-menu offset-y open-on-hover :close-on-content-click="false">
    <template v-slot:activator="{ on }">
      <v-btn v-on="on">
        <v-badge :color="color" bottom :value="itemQuantity" :content="itemQuantity">
          <v-icon>mdi-cart</v-icon>
        </v-badge>
      </v-btn>
    </template>
    <v-list v-if="itemQuantity">
      <v-list-item v-for="(product, index) in itemBasket" :key="index">
        <v-list-item-title>
          <v-card>
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title class="headline" v-text="product.name"></v-card-title>
              </div>
              <div>
                <v-card-subtitle>
                  <v-text-field
                    type="number"
                    v-model="product.quantity"
                    @input="updateQuantity(product)"
                  ></v-text-field>
                </v-card-subtitle>
              </div>
            </div>
          </v-card>
        </v-list-item-title>
      </v-list-item>
      <v-card-actions>
        <v-btn to="/basket">Voir le panier</v-btn>
      </v-card-actions>
    </v-list>
  </v-menu>
</template>
<script src="./basket.js"/>