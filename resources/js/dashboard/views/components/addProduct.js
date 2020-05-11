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
            fruitList: [{
                name: "",
            }],
            search: null,

        }
    },
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                this.fruitList[0].name = val
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
            Axios.post('../api/addProduct', {
                name: this.product,
                id_producer: this.producer,
                prix: this.prix,
                fruits: this.fruits
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
        createFruit(val){
            console.log(val)
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