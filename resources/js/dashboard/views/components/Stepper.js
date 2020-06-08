import { basketService } from "../../_services/basket.service"

export default {
    data() {
        return {
            e1: 1,
            orderList: [],
            nom: '',
            prenom: '',
            ville: '',
            codePostal: '',
            pays: '',
            adresse: '',
            hidden: true,
            checkbox: false,
        }
    },

    created() {
        this.getOrder();
    },
    methods: {
        getOrder() {
            this.orderList = basketService.getBasket();
        },
        displayInputs() {
            if (this.checkbox === true) {
                this.hidden = false;
            }
            else {
                this.hidden = true;
            }
        }
    }
}
/* basketService.sendOrder().then(response => {
                  console.log(response)
              }) */
                          //Valider commande, adresse et validation adresse de facturation, paiement
