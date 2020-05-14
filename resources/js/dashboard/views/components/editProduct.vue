<template>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
    
        <v-btn icon color="blue" v-on="on"><v-icon>mdi-pencil</v-icon></v-btn>
      </template>
      <v-card>
        <v-card-title >
          <span class="headline" >Modification de : {{item.name}}</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field color="teal" v-model="item.name" label="Nom de la confiture*" required> </v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field color="teal" v-model="producer" label="Producteurs*" required></v-text-field>
              </v-col>
                <v-col cols="12" sm="6" md="4">
                <v-text-field color="teal" v-model="fruits" label="Fruits*" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field color="teal" v-model="prix" label="Prix*" required></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*Champ obligatoire</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="teal" text @click="dialog = false">Fermer</v-btn>
          <v-btn color="teal" text @click="dialog = false,editItem(item)">Enregistrer</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script src="./editProduct.js"/>