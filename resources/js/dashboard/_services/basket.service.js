import EventBus from '../eventBus';
//Export des fonctions du BasketService
export const basketService = {
    add,
    getBasket,
    basketSize,
    replaceQuantity,
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
function replaceQuantity(product) {
    let basket = getBasket()
    if (_.hasIn(basket, buildKey(product))) {
        basket[buildKey(product)] = product
    }
    else {
        throw 'Err'
    }
    storeBasket(basket)
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
