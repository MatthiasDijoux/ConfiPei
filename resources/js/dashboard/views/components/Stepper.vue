<template>
<v-container>
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
        <v-row dense v-for="(product, i) in order.orderList" :key="i" cols="12">
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

      <v-stepper-content step="2" class="text-center">
        <span>Adresse de livraison</span>
          <v-row>
            <v-col col="2" md="4">
              <v-text-field label="Nom*" :rules="rules" v-model="order.adresseLivraison.nom"></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field label="Prenom*" :rules="rules" v-model="order.adresseLivraison.prenom"></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field label="Pays*" :rules="rules" v-model="order.adresseLivraison.pays"></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field label="Ville*" :rules="rules" v-model="order.adresseLivraison.ville"></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Adresse*"
                :rules="rules"
                v-model="order.adresseLivraison.adresse"
              ></v-text-field>
            </v-col>
            <v-col col="2" md="4">
              <v-text-field
                label="Code Postal*"
                :rules="rules"
                v-model="order.adresseLivraison.codePostal"
              ></v-text-field>
            </v-col>
          </v-row>
        <v-switch v-model="selectable" label="Changer adresse de facturation"></v-switch>
        <div v-if="selectable">
          <v-divider></v-divider>

          <span>Adresse de facturation</span>
            <v-row>
              <v-col col="2" md="4">
                <v-text-field label="Nom*" :rules="rules" v-model="order.adresseFacturation.nom"></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Prenom*"
                  :rules="rules"
                  v-model="order.adresseFacturation.prenom"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field label="Pays*" :rules="rules" v-model="order.adresseFacturation.pays"></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Ville*"
                  :rules="rules"
                  v-model="order.adresseFacturation.ville"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Adresse*"
                  :rules="rules"
                  v-model="order.adresseFacturation.adresse"
                ></v-text-field>
              </v-col>
              <v-col col="2" md="4">
                <v-text-field
                  label="Code Postal*"
                  :rules="rules"
                  v-model="order.adresseFacturation.codePostal"
                ></v-text-field>
              </v-col>
            </v-row>
        </div>
        <v-btn color="primary" :disabled="!valid" @click="e1 = 3,sendOrder() ">Valider</v-btn>

        <v-btn text @click="e1 = 1">Retour</v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
        <span>Récapitulatif de la commande :</span>

        <v-row dense v-for="(product, i) in order.orderList" :key="i" cols="12">
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
        <v-row>
          <v-col md="12">
            <v-btn color="success" @click="process">Payer</v-btn>
          </v-col>
        </v-row>

        <v-btn text @click="e1 =2">Retour</v-btn>
      </v-stepper-content>
    </v-stepper-items>
  </v-stepper>
</v-container>
</template>

<script src="./Stepper.js"/>