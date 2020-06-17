import dialogProduct from '../views/components/dialogProduct.vue';
import {clientService} from '../_services/clientService';
export default {
    components: {
        dialogProduct,
    },
    data: () => ({
        dialog: false,
        headers: [{
                text: "Confiture",
                align: "start",
                sortable: false,
                value: "produit"
            },
            { text: "Producteurs", value: "producteur" },
            { text: "Fruits", value: "fruits" },
            { text: "Prix", value: "prix" },
            { text: "Image", value: "image" },
            { text: "Actions", value: "actions" },
        ],
        editItem:{
            name:"salut"
        },
        products: [],

    }),
    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            clientService.get("/api/products").then(({ data }) =>
                data.data.forEach(data => {
                    this.products.push(data);
                })
            );
        },
        displayFruits(items){
            var fruits=[];
            items.forEach(item=>{
                fruits.push((item.name))
            })
            return fruits.join(', ');
        }
    }
};