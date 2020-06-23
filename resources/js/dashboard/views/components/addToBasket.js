import { basketService } from '../../_services/basket.service';
export default {
    data() {
        return {
            quantity: 0,
        }
    },
    props: {
        product: {
            required: true
        },
    },
    created() {
    },
    methods: {
        add() {
            basketService.add(this.product, this.quantity);
            this.quantity = 0
        },

    }
}