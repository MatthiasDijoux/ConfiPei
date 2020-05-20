import Axios from "axios";
export default {
    data: () => ({
        products: [],
        fruits: [],
        loading: false,
        productsDisplay: [],
        fruitList: [],
        search: null,
    }),
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                Axios.get('/api/Fruits', { params: { query: val } })
                    .then(({ data }) => {
                        this.loading = false

                        data.forEach(fruit => {
                            this.fruitList.push(fruit)
                        })
                    })
            }
        },
    },

    methods: {
        displayProduct() {
            Axios.get("/api/products")
                .then(({ data }) =>
                    data.data.forEach(produit => {
                        this.products.push(produit)

                    }))
            this.productsDisplay = this.products
                ;
        },
        filterFruit() {
            this.productsDisplay = []

            let _productsDisplay = []
            if (_.isEmpty(this.fruits)) {
                this.productsDisplay = this.products
            }
            else {
                this.products.forEach(produit => {
                    if (produit) {
                        let _product = produit
                        produit.fruits.forEach(fruit => {
                            if (_.includes(this.fruits, fruit.name)) {
                                _productsDisplay[_product.id] = _product
                            }
                        })
                    }
                })
                _productsDisplay.forEach(_produit => {
                    this.productsDisplay.push(_produit)

                })
            }
        },

        displayFruits(_fruits) {
            var fruits = [];
            _fruits.forEach(_fruit => {
                fruits.push((_fruit.name))
            })
            return fruits.join(', ');
        }
    },

    created() {
        this.displayProduct()
    },
}