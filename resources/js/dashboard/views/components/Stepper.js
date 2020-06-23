import { basketService } from "../../_services/basket.service";
import { clientService } from "../../_services/clientService";
export default {
    data() {
        return {
            apiKey: 'pk_test_51GsSUCKE28gKigAxu1r1aC9pzGq1uxMSOfpN6frx5AFv7mCt0qw4r2AdiDTmLKK317aayIUYbH0KvpDh0OVugGpM00gLWG1Xjk',
            panel: [0],
            source: null,
            e1: 1,
            valid: true,
            priceTotal: [],
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
            orderId: '',
            status: '',
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
            if (this.selectable === false) {
                _.assign(this.order.adresseFacturation, this.order.adresseLivraison)
            }
            basketService.sendOrder(this.order).then(response => {
                this.orderId = response.data.data.id
            })
        },
        process() {
            clientService.post('/api/orders/' + this.orderId + '/paiement', {
                id: this.source.id
            }).then(response => {
                console.log(response.data.status.order_status)
            })
        }
    }
}
//step1: valide sa commande cout total,
//step 2 : moyen de livraison, envoie en bdd -> création commande, 
//rajouter une partie status de la commande (payé, pas encore, remboursé),retourne commande -> step 3, step3: id commande + carte  = paiement de la commande youpi ! ! ! 