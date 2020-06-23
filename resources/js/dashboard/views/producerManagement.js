import { clientService } from '../_services/clientService.js';
import drawerProducer from './components/drawerProducer.vue';
export default {
    components: {
        drawerProducer
    },
    data() {
        return {
            producers: [],
            headers: [
                {
                    text: 'Producteur',
                    align: 'start',
                    sortable: false,
                    value: 'name',
                },
                { text: 'Username', value: 'username' },
                { text: 'Email', value: 'mail' },
                { text: 'Actions', value: 'actions' },

            ],
            isModification: true,
        }

    },
    created() {
        this.getProducers()
    },
    methods: {
        getProducers() {
            clientService.get('/api/producers').then(response => {
                response.data.data.forEach(producer => {
                    this.producers.push(producer)
                })
            })
        },
    }
}