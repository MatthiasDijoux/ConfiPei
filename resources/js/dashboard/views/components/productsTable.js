import dialogProduct from './dialogProduct.vue';
import { clientService } from '../../_services/clientService';
import { authenticationService } from '../../_services/authentication.service';
export default {
    components: {
        dialogProduct,
    },
    data: () => ({
        dialog: false,
        availableHeaders: {
            confiture: { text: "Confiture", align: "start", sortable: false, value: "produit" },
            producteur: { text: "Producteurs", value: "producteur" },
            fruits: { text: "Fruits", value: "fruits" },
            prix: { text: "Prix", value: "prix" },
            image: { text: "Image", value: "image" },
            actions: { text: "Actions", value: "actions" },
        },
        headers: [],
        editItem: {
            name: "salut"
        },
        products: [],

    }),
    created() {
        this.initialize();
        this.setHeaders();
    },

    methods: {
        initialize() {
            let url = authenticationService.isProducer() ? "/api/producers/products" : "/api/products"
            console.log(authenticationService.isProducer())
            clientService.get(url).then(({ data }) =>
                data.data.forEach(data => {
                    this.products.push(data);
                })
            );
        },
        setHeaders() {
            if (authenticationService.isProducer()) {
                this.headers = [
                    this.availableHeaders.confiture,
                    this.availableHeaders.fruits,
                    this.availableHeaders.image,
                    this.availableHeaders.prix,
                    this.availableHeaders.actions,
                ]
            }
            else {
                this.headers = [
                    this.availableHeaders.confiture,
                    this.availableHeaders.producteur,
                    this.availableHeaders.fruits,
                    this.availableHeaders.image,
                    this.availableHeaders.prix,
                    this.availableHeaders.actions,
                ]
            }
        },
        displayFruits(items) {
            var fruits = [];
            items.forEach(item => {
                fruits.push((item.name))
            })
            return fruits.join(', ');
        }
    }
};