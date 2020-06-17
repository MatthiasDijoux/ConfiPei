import Vue from 'vue';
import Routes from './Router.js';
import Layout from './Layouts/Layout.vue';
import Vuetify from 'vuetify';
import VStripeElements from 'v-stripe-elements/lib';
import LoadScript from 'vue-plugin-load-script'
Vue.use(LoadScript)
Vue.use(Vuetify);
Vue.use(VStripeElements);
const app = new Vue({
    el: '#admin',
    vuetify: new Vuetify({}),
    router: Routes,
    components: { Layout }
})
export default new Vuetify(app)