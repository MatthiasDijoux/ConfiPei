import { clientService } from '../_services/clientService.js';
export default {
    data() {
        return {
            producers: [],
        }
    },
    methods: {
        getProducers() {
            clientService.get('./api/producers').then(response => {
                console.log(response)
            })
        }
    }
}