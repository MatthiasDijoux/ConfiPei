<template>
  <v-container>
    <v-row dense v-for="(product, i) in basket" :key="i" cols="12">
      <v-col>
        <v-card>
          <div class="d-flex justify-space-between">
            <div>
              <v-card-title class="headline" v-text="product.name"></v-card-title>
              <v-card-subtitle v-text="'Prix:'+product.price"></v-card-subtitle>
              <v-card-subtitle v-text="'Nombre de produit:'+product.quantity"></v-card-subtitle>
              <v-card-subtitle v-text="'Total:'+product.price * product.quantity"></v-card-subtitle>
            </div>

            <div>
              <v-card-actions>
                <v-text-field
                  type="number"
                  v-model="product.quantity"
                  @input="updateQuantity(product)"
                ></v-text-field>
              </v-card-actions>
            </div>
          </div>
        </v-card>
      </v-col>
    </v-row>
    <v-btn @click="sendOrder()">Passer la commande</v-btn>
  </v-container>
</template>
<script src="./basketOrder.js"/>