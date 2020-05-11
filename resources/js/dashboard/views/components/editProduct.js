import Axios from "axios"

export default {
    props: ["item", "activities"],
    data() {
        return {
            dialog: false,
            name: '',
            producer: '',
            fruits: '',
            prix: '',
        }
    },
    methods: {

        editItem(item) {
            const index = this.activities.indexOf(item);
            Axios.patch('../api/products/' + item.id, {
                })
                .then(response => {
                    if (response.status === 200) {
                        console.log("Données modifiés")
                        this.$emit('editActivities', response.data.data)
                        this.activities.splice(index, 1)
                    }
                })
                .catch(response => {
                    console.log("Erreur code " + response.status)
                })

        },
    }
}