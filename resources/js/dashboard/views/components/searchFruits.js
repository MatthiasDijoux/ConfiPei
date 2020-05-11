import Axios from "axios"

export default {

    data() {
        return {
            val: [],
            loading: "",
            productList: [],
            recherche: null,
        }

    },
    methods: {
        search(val) {

            if (val && val.length > 2) {

                this.productList.name = val;

                this.loading = true
                axios.get('/api/Fruits', { params: { query: val } })
                    .then(({ data }) => {
                        this.loading = false;
                        console.log(data)
                        data.forEach(product => {
                            this.productList.push(product)
                            console.log(this.productList)
                        });

                    });
            }
        }
    },

    created() {
        this.search();
    },


}