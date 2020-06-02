import { clientService } from '../_services/clientService';

export default {
    data: () => ({

    }),
    created() {
        this.getUser();
    },
    methods: {
        getUser() {
            clientService.get('../api/profil').then(response=>{
                console.log(response.data)
            })
        }
    }

}