import { basketService } from "../../_services/basket.service"

export default {
    data() {
        return {
            e1: 1,
            valid: true,
            order: {
                orderList: {
                },
                adresseLivraison: {
                    nom: '',
                    prenom: '',
                    ville: '',
                    codePostal: '',
                    pays: '',
                    adresse: '',
                },
                adresseFacturation: {
                    nom: '',
                    prenom: '',
                    ville: '',
                    codePostal: '',
                    pays: '',
                    adresse: '',
                },
            },
            rules: [
                value => !!value || 'Required.',
            ],
            selectable: false,
            hidden: true,
            checkbox: false,
        }
    },

    created() {
        this.getOrder();
    },
    methods: {
        getOrder() {
            this.order.orderList = basketService.getBasket();
        },
        sendOrder() {
            if (this.checkbox === false) {
                _.assign(this.order.adresseFacturation, this.order.adresseLivraison)
            }
        },
        process() {
            basketService.sendOrder(this.order).then(response => {
                console.log(response)
            })
        }
    }
}