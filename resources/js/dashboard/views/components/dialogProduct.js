import Axios from "axios";
import uploadImage from "./uploadImage.vue";
export default {
    components: {
        uploadImage,
    },
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
                id_producer: this.producer,
                prix: this.prix,
                fruits: this.fruits,
                id: this.id
            })
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

        uploadImage() {
            console.log('upload')
            let url = ""
            if (!this.product.id) {
                url = '/api/uploadImage/'
            }
            else {
                url = '/api/uploadImage/' + this.product.id
            }
            console.log(url)
            axios.post(url, {
                image: this.image
            })
                .then(function ({ data }) {
                    // console.log(data);
                })
                .catch(function (error) {
                    console.log(error);
                });
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
            this.producer = product.producer.id
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
