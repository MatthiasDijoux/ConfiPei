<template>
  <v-dialog v-model="dialog" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="teal" fab dark icon small v-on="on">
        <v-icon v-if="!isModification">mdi-plus</v-icon>
        <v-icon v-if="isModification" @click="editProduct(product)">mdi-pencil</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="headline" v-if="!isModification">Ajouter une confiture</span>
        <span class="headline" v-if="isModification">Modifier confiture</span>
      </v-card-title>
      <v-card-text>
        <v-container>
          <v-row>
            <v-col cols="12" sm="6" md="4">
              <v-text-field
                color="teal"
                v-model="productName"
                label="Nom de la confiture*"
                required
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-select
                :items="producers"
                item-value="id"
                v-model="producer"
                item-text="name"
                label="Producteur"
              ></v-select>
            </v-col>
            <v-col cols="12" sm="6" md="4">
              <v-text-field color="teal" v-model="prix" label="prix*" required></v-text-field>
            </v-col>

            <v-col cols="12" sm="6" md="6">
              <v-autocomplete
                v-model="fruits"
                :loading="loading"
                :items="fruitList"
                :search-input.sync="search"
                item-text="name"
                @input="createFruit"
                return-object
                multiple
                cache-items
                hide-no-data
                hide-details
                placeholder="Fruits*"
                label="Fruit"
              >
                <template v-slot:prepend>
                  <v-btn icon color="success" :disabled="fruits.length == 0">
                    <v-icon>mdi-plus-circle</v-icon>
                  </v-btn>
                </template>
              </v-autocomplete>
              <v-col cols="12" sm="6" md="12">
                <v-file-input  v-on:change="onFileChange"></v-file-input>
              </v-col>
            </v-col>
          </v-row>
        </v-container>
        <small>*Champ obligatoire</small>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="teal" text @click="dialog = false">Fermer</v-btn>
        <v-btn color="teal" text @click="dialog = false,addDatas(),uploadImage()">Enregistrer</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script src="./dialogProduct.js">