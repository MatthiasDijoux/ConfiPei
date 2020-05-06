import Axios from "axios"

export default {
    data() {
        return {
            dialog: false,
            informations: '',
            fruits:'',
            producer:'',
            product:'',
            producers: [],
            prix:'',
        }
    },

    methods: {
       
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
                    console.log(response.data)
                }
            })
            .catch(
                console.log(this.product + this.producer)
            )
        }, 
        getProducer(){
            Axios.get("/api/users").then(({ data }) =>
            data.data.forEach(data => {
                this.producers.push(data.id_producer);
            })
        );       
     },
    

    },
    created() {
        this.getProducer();
    },
}