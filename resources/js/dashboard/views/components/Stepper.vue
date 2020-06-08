<template>
  <v-stepper v-model="e1">
    <v-stepper-header>
      <v-stepper-step :complete="e1 > 1" step="1">Confirmation de la commande</v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step :complete="e1 > 2" step="2">Adresse de livraison</v-stepper-step>

      <v-divider></v-divider>

      <v-stepper-step step="3">Paiement</v-stepper-step>
    </v-stepper-header>

    <v-stepper-items>
      <v-stepper-content step="1">
        <v-row dense v-for="(product, i) in orderList" :key="i" cols="12">
          <v-col>
            <v-card>
              <div class="d-flex justify-space-between">
                <div>
                  <v-card-title class="headline" v-text="product.name"></v-card-title>
                  <v-card-subtitle v-text="'Prix:'+product.price"></v-card-subtitle>
                  <v-card-subtitle v-text="'Nombre de produit:'+product.quantity"></v-card-subtitle>
                  <v-card-subtitle v-text="'Total:'+product.price * product.quantity"></v-card-subtitle>
                </div>
              </div>
            </v-card>
          </v-col>
        </v-row>
        <v-btn color="primary" @click="e1 = 2">Valider</v-btn>

        <v-btn to="/basket" text>Annuler</v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">
        <span>Adresse de facturation</span>
        <v-text-field label="Nom" v-model="nom"></v-text-field>
        <v-text-field label="Prenom" v-model="prenom"></v-text-field>
        <v-text-field label="Pays*" v-model="pays"></v-text-field>
        <v-text-field label="Ville*" v-model="ville"></v-text-field>
        <v-text-field label="Adresse*" v-model="adresse"></v-text-field>
        <v-text-field label="Code Postal*" v-model="codePostal"></v-text-field>
        <v-checkbox v-model="checkbox" label="Oui" @change="displayInputs()"></v-checkbox>
        <div :hidden="hidden">
          <v-text-field label="Nom" v-model="nom"></v-text-field>
          <v-text-field label="Prenom" v-model="prenom"></v-text-field>
          <v-text-field label="Pays*" v-model="pays"></v-text-field>
          <v-text-field label="Ville*" v-model="ville"></v-text-field>
          <v-text-field label="Adresse*" v-model="adresse"></v-text-field>
          <v-text-field label="Code Postal*" v-model="codePostal"></v-text-field>
        </div>
        <v-btn color="primary" @click="e1 = 3">Valider</v-btn>

        <v-btn text>Cancel</v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
        <v-btn color="primary" @click="e1 = 1">Continue</v-btn>

        <v-btn text>Cancel</v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</template>

<script src="./Stepper.js"/>