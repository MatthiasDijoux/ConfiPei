import EventBus from '../eventBus';
import {clientService} from './clientService.js';
//Export des fonctions du BasketService
export const basketService = {
    add,
    getBasket,
    basketSize,
    replaceQuantity,
    sendOrder,
}

/**
 * Ici on ajoute à l'object basket récupéré au préalable avec la function getBaskeet et on y store ou update l'objet basket
 * @param {*} product 
 * @param {*} quantity 
 */
function add(product, quantity) {
    //Défini l'objet basket
    let basket = getBasket()

    //Vérifie que l'objet basket contenant le produit existe ou non
    //si non, on définie l'objet    
    if (!_.hasIn(basket, buildKey(product))) {
        basket[buildKey(product)] = {
            id: product.id,
            name: product.name,
            quantity: parseInt(quantity),
            price: product.prix
        }
    }
    //si  oui, on incrémente la quantité actuelle
    else {
        basket[buildKey(product)].quantity += parseInt(quantity)
    }
    //on appelle la fonction store pour l'ajouté au local storage
    storeBasket(basket)

}
/**
 * Cette fonction nous set à remplacer la quantité du produit précédent 
 * @param {*} product 
 */
function replaceQuantity(product) {
    let basket = getBasket()
    if (_.hasIn(basket, buildKey(product))) {
        basket[buildKey(product)] = product
        if ((basket[buildKey(product)].quantity) == 0) {
            _.unset(basket, buildKey(product))
        }
    }
    else {
        throw 'Err'
    }
    storeBasket(basket)
}

function sendOrder() {
    let basket = getBasket();
    let ordersList = [];
    for (let i in basket) {
        let obj = {}
        obj['id'] = basket[i].id
        obj['quantity'] = basket[i].quantity
        ordersList.push(obj)
    }
    return clientService.post('/api/order', {
        order: ordersList,
    })
}

/**
 * @param {*} product 
 * @returns on retourne l'identifiant du produit
 */
function buildKey(product) {
    return 'product_' + product.id
}

/**
 * Function getBasket
 * Ici on vérifie que le panier existe ou non et on return basket
 * @returns On return l'objet basket
 * */
function getBasket() {
    let basket = localStorage.getItem("currentBasket");

    if (!basket) {
        basket = {}
    }
    else {
        basket = JSON.parse(basket)
    }
    return basket
}

/**
 * Function pour creer le localstorage current basket où on vient storer l'objet basket
 * @param {*} basket 
 * 
 */
function storeBasket(basket) {
    localStorage.setItem("currentBasket", JSON.stringify(basket))
    EventBus.$emit('basket', basket)
    emitProductsSize(basket)
}

function emitProductsSize(basket) {
    EventBus.$emit('basketSize', _.toPairsIn(basket).length)
}
function basketSize() {
    let basket = getBasket()
    basket = _.toPairsIn(basket).length
    return basket
}
