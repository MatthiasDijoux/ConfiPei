import Axios from "axios"

export default {
    props: {
        product: {
            default: function () {
                return {

                }
            }
        },
        isModification: {
            default: false
        }
    },

    data() {

        return {
            dialog: false,
            informations: '',
            producer: '',
            productName: '',
            producers: [],
            prix: '',
            id: '',
            fruits: [],
            loading: false,
            fruitList: [],
            search: null,
        }
    },
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
        //TODO Refaire les routes api //
        addDatas() {
            //Le fruit doit avoir un name et un id, ou juste un name
            Axios.post('../api/updateProduct', {
                name: this.productName,
                id_producer: this.producer.id,
                prix: this.prix,
                fruits: this.fruits,
                id: this.product.id
            })
                .then(response => {
                    if (response.status === 201) {
                        console.log("Données enregistrée")
                        console.log(this.product.id)
                        this.$emit('addProduct', response.data)
                    }
                })
                .catch(
                    console.log(this.productName + this.producer)
                )
        },
        createFruit(val) {
            console.log(val)
        },

        getProducer() {
            Axios.get("/api/products").then(({ data }) =>
                data.data.forEach(data => {
                    this.producers.push(data.producer);
                })
            );
        },
        editProduct(product) {
            this.productName = product.name
            this.producer = product.producer
            this.prix = product.prix
            this.fruits = product.fruits
            _.merge(this.fruitList, this.fruits)
            this.id = product.id

        }


    },

    created() {
        this.getProducer();
    },
}
