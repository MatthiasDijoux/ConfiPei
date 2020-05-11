import Axios from "axios";
import addProduct from '../views/components/addProduct.vue';
import editProduct from '../views/components/editProduct.vue';
export default {
    components: {
        addProduct,
        editProduct
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
            { text: "Actions", value: "actions" },
        ],
        products: [],

    }),
    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            Axios.get("/api/users").then(({ data }) =>
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