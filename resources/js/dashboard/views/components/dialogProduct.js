import Axios from "axios";
import { clientService } from '../../_services/clientService';
import { authenticationService } from "../../_services/authentication.service";
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
            image: '',
            fruits: [],
            loading: false,
            fruitList: [],
            search: null,
            isProducer: authenticationService.isProducer(),
        }
    },
    watch: {
        search: function (val) {
            if (val && val.length > 2) {
                clientService.get('/api/fruits', { query: val })
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
            let datasToAdd = {
                name: this.productName,
                prix: this.prix,
                fruits: this.fruits,
                image: this.image,
                id: this.id
            }
            if (!this.isProducer) {
                datasToAdd['id_producer'] = this.producer
            }

            let url = this.isProducer ? "/api/producers/products" : "/api/products"

            //Le fruit doit avoir un name et un id, ou juste un name
            clientService.post(url, datasToAdd)
                .then(response => {
                    if (response.status === 200) {
                        console.log("Données enregistrée")
                        console.log(response.data)
                        this.$emit('addProduct', response.data)
                    }
                })
                .catch(
                    console.log("erreur")
                )
        },

        onFileChange(file) {
            let image = new Image;
            let reader = new FileReader;

            reader.onload = (file) => {
                console.log(file)
                this.image = file.target.result;
            };
            reader.readAsDataURL(file);
        },


        createFruit(val) {
            console.log(val)
        },

        getProducer() {

            if (!this.isProducer) {
                clientService.get("/api/producers").then(({ data }) =>
                    data.data.forEach(data => {
                        this.producers.push(data);
                    })
                );
            }
        },
        editProduct(product) {
            this.productName = product.name
            if (!this.isProducer) {
                this.producer = product.producer.id
            }
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

