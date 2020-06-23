import { clientService } from "../../_services/clientService"

export default {
    props: {
        producer: {
            default: function () {
                return {}
            }
        },
        isModification: {
            default: false
        }
    },
    data() {
        return {
            drawer: null,
            producerName: '',
            producerUsername: '',
            producerMail: '',
            producerId_User: '',
            id: '',
            editItem: {
                name: '',
                id_user: {
                    username: '',
                    mail: '',
                }
            },
        }
    },
    methods: {
        addOrUpdate() {
            clientService.post('/api/producers', {
                id: this.id,
                name: this.producerName,
                id_user: this.producerId_User,
                username: this.producerUsername,
                mail: this.producerMail,
            }).then(response => {
                this.editItem = response.data.data
                this.$emit('update', this.editItem)
            });
        },
        editProducer(producer) {
            this.id = producer.id
            this.producerName = producer.name
            this.producerUsername = producer.id_user.username
            this.producerMail = producer.id_user.mail
            this.producerId_User = producer.id_user.id
        }
    },
    created() {
    }
}