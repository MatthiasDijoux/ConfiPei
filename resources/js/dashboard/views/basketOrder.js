import { basketService } from './../_services/basket.service.js';
import EventBus from './../eventBus.js';
import { clientService } from './../_services/clientService.js';
import { authenticationService } from '../_services/authentication.service.js';
export default {
    data: () => ({
        basket: [],
        ordersList: [],
        ordersId: [],
        ordersQuantity: [],
    }),
    created() {
        this.getBasket()
        EventBus.$on('basket', (basket) => {
            this.basket = basket
        })
    },
    methods: {
        getBasket() {
            this.basket = basketService.getBasket()
        },
        updateQuantity(product) {
            this.orders = product
            if (product.quantity == 0) {
                if (confirm('Voulez-vous vraiment supprimer ce produit de votre liste')) {
                    basketService.replaceQuantity(product)
                }
                else {
                    product.quantity = 1
                    basketService.replaceQuantity(product)
                }
            }

        },
        sendOrder() {
            if (!authenticationService.currentUser) {
                this.$router.push('/login')
            }
            else {
                this.$router.push('/confirmation')
            }
              
        }
    }
}
