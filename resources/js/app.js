require('./bootstrap');
import Vue from 'vue';

import Layout from './layouts/Layout';

const app = new Vue({
    el: '#admin',
    components: { Layout }
})


export default (app);