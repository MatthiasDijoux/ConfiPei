import Vue from 'vue';
import Routes from './Router.js';
import Layout from './Layouts/Layout.vue';
import Vuetify from 'vuetify';

Vue.use(Vuetify);

const app = new Vue({
    el:'#admin',
    vuetify: new Vuetify({}),
    router: Routes,
    components:{Layout}
})
export default new  Vuetify(app)