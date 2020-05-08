import Axios from "axios"

export default {
    data() {

        return {
            dialog: false,
            informations: '',
            producer: '',
            product: '',
            producers: [],
            prix: '',
            fruits: [],
            loading: false,
            fruitList: [],
            search: null,
        }
    },
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                Axios.get('/api/getFruits', { params: { query: val } })
                    .then(({ data }) => {
                        this.loading = false

                        data.forEach(fruit => {
                            this.fruitList.push(fruit.name)
                        })
                    })
            }
        },
    },

    methods: {
        //TODO Refaire les routes api //
        addDatas() {
            Axios.post('../api/addProduct', {
                name: this.product,
                id_producer: this.producer,
                prix: this.prix,
            })
                .then(response => {
                    if (response.status === 201) {
                        console.log("Données enregistrée")
                        this.$emit('addProduct', response.data)
                    }
                })
                .catch(
                    console.log(this.product + this.producer)
                )
        },

        getProducer() {
            Axios.get("/api/users").then(({ data }) =>
                data.data.forEach(data => {
                    this.producers.push(data.producer);
                })
            );
        },


    },

    created() {
        this.getProducer();
    },
}