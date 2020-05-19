import Axios from "axios";
import dialogProduct from '../views/components/dialogProduct.vue';
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
            Axios.get("/api/products").then(({ data }) =>
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