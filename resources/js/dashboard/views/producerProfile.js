import { authenticationService } from "../_services/authentication.service"
import Axios from "axios"
export default {
    data: () => ({
        producer: []
    }),
    methods: {
        displayProfile() {
            Axios.get('/api/producer/' + authenticationService.currentUserValue.id)
                .then((data => {
                    this.producer = (data.data.data)
                }))
        }
    },
    created() {
        this.displayProfile()
    }
}