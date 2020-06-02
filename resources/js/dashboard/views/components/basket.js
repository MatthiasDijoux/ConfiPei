import { basketService } from '../../_services/basket.service';
import EventBus from '../../eventBus';

export default {
    data() {
        return {
            itemQuantity: 0,
            itemBasket: [],
            color: 'orange',
        }
    },
    created() {
        this.itemQuantity = basketService.basketSize()
        this.initTable(basketService.getBasket())
        EventBus.$on('basketSize', (basketSize) => {
            this.itemQuantity = basketSize
            this.initTable(basketService.getBasket())
        })
    },
    methods: {
        initTable(itemBasket) {
            this.itemBasket = []
            let counter = 0
            let BreakException = {}
            try {
                for (var key in itemBasket) {
                    var item = itemBasket[key]
                    this.itemBasket.push(item)
                    counter++
                    if (counter === 3) {
                        throw BreakException
                    }
                }
            }
            catch (e) {
                if (e !== BreakException) {
                    throw e
                }
            }
        },
        updateQuantity(product) {
            basketService.replaceQuantity(product)
        }

    }
}
