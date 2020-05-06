import Axios from "axios";
import addProduct from '../views/components/addProduct.vue'
export default {
    components: {
        addProduct,
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