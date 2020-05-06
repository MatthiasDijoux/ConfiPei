<template>
  <v-dialog v-model="dialog" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="teal" fab dark small v-on="on">
        <v-icon>mdi-plus</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline">Ajouter une confiture</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="4">
              <v-text-field color="teal"  v-model="product" label="Nom de la confiture*" required></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-select  :items="producers" item-value="id" v-model="producer" item-text="name" label="Producteur"></v-select>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field color="teal"  v-model="prix" label="prix*" required></v-text-field>
            </v-col>
          </v-row>
        </v-container>
        <small>*Champ obligatoire</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="teal" text @click="dialog = false">Fermer</v-btn>
        <v-btn color="teal" text @click="dialog = false, addDatas()">Enregistrer</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script src="./addProduct.js">