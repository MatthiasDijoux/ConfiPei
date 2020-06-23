import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './views/Home.vue';
import Dashboard from './views/Dashboard.vue';
import Login from './Login.vue';
import Product from './views/Product.vue';
import producerProfile from './views/producerProfile.vue';
import { Role } from './_helpers/role';
import { authenticationService } from '../dashboard/_services/authentication.service'
import Profil from './views/Profil.vue';
import Basket from './views/basketOrder.vue';
import Stepper from './views/components/Stepper.vue';
import producerManagement from './views/producerManagement.vue';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
        },
        {
            path: '/confitures',
            name: 'confitures',
            component: Product,
        },
        {
            path: '/basket',
            name: 'basket',
            component: Basket,
        },
        {
            path: '/producerManagement',
            name: 'producerManagement',
            component: producerManagement,
        },
        {
            path: '/dashboardProducteur',
            name: 'producteur',
            component: producerProfile,
            meta: { authorize: [Role.Producteur] }
        },
        {
            path: '/confirmation',
            name: 'stepper',
            component: Stepper,
            meta: { authorize: [Role.Producteur, Role.Admin, Role.Client] }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: { authorize: [] }

        },
        {
            path: '/profil',
            name: 'profil',
            component: Profil,
            meta: { authorize: [] }

        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: { authorize: [Role.Admin] }
        },
    ],

})
router.beforeEach((to, from, next) => {

    // redirect to login page if not logged in and trying to access a restricted page
    const { authorize } = to.meta;

    if (authorize && !_.isEmpty(authorize)) {

        const currentUser = authenticationService.currentUserValue;

        if (!currentUser) {
            // not logged in so redirect to login page with the return url
            return next({ path: "/login", query: { returnUrl: to.path } });
        }

        // check if route is restricted by role
        if (authorize.length && !authorize.includes(currentUser.role.name)) {
            // role not authorised so redirect to home page
            return next({ path: "/" });
        }

    }

    return next();
});




export default router;
