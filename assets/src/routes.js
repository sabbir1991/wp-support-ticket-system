import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use( VueRouter );

import Tickets from './components/Tickets.vue';
import SingleTicket from './components/SingleTicket.vue';

let routes = [
    { path: '/', component: Tickets },

    { path: '/tickets/:ticketId', component: SingleTicket },

    { path: '*', redirect: '/' }
];

export default new VueRouter({
    routes,
});