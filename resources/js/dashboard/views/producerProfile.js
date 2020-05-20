import {authenticationService} from "../_services/authentication.service"
import Axios from "axios"
export default {
    data: () => ({
        producer: []
    }),
    methods: {
        displayProfile() {
            console.log(authenticationService.currentUserValue.id)
            Axios.post('/api/producer', {
                id:''
            })
        }
    },
    created() {
        this.displayProfile()
    }
}