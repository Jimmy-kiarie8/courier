
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import 'w3-css/w3.css';
import Vuetify from 'vuetify'
import Print from 'vue-print-nb'
// import * as VueGoogleMaps from 'vue2-google-maps'
import VueChartkick from 'vue-chartkick'
import Chart from 'chart.js'

import VueCharts from 'vue-chartjs'
import { Bar, Line } from 'vue-chartjs'

Vue.use(VueChartkick, {adapter: Chart})
 
/*Vue.use(VueGoogleMaps, {
  load: {
    // key: 'AIzaSyBNzKeF6ZwxlAOUCyeH8UxvvYRHP_w_Guk',
    libraries: 'places',
  },
})*/
 
Vue.use(Print); 
Vue.use(Vuetify)
Vue.use(VueRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let dashboard = require('./components/Dashboard.vue');

let myHeader = require('./components/include/Header.vue');
let myUser = require('./components/users/User.vue');
let myRole = require('./components/roles/Role.vue');
let myShipment = require('./components/shipments/Shipment.vue');
let myScanner = require('./components/scanner/Scanner.vue');
let myContainer = require('./components/containers/Container.vue');
let myMap = require('./components/reports/Map.vue');
let myBranch = require('./components/branches/Branch.vue');
let myProfile = require('./components/users/Profile.vue');
let myCompany = require('./components/company/Company.vue');

const routes = [
{path: '/', component: dashboard },
{path: '/users', component: myUser },
{path: '/roles', component: myRole },
{path: '/shipments', component: myShipment },
{path: '/scanner', component: myScanner },
{path: '/containers', component: myContainer },
{path: '/branches', component: myBranch },
{path: '/profile', component: myProfile },
{path: '/companies', component: myCompany },
]
const router = new VueRouter({
// mode: 'history',
	routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
    components: {
    	myHeader, myUser, myRole, myShipment, myScanner, myContainer, myMap,
        myBranch, myProfile, myCompany
    },
    data: {
    shipments: [],
    loading: false,
    error: false,
    query: ''
},
methods: {
    search: function() {
        // Clear the error message.
        this.error = '';
        // Empty the shipments array so we can fill it with the new shipments.
        this.shipments = [];
        // Set the loading property to true, this will display the "Searching..." button.
        this.loading = true;

        // Making a get request to our API and passing the query to it.
        this.$http.get('/search?q=' + this.query).then((response) => {
            // If there was an error set the error message, if not fill the shipments array.
            response.body.error ? this.error = response.body.error : this.shipments = response.body;
            // The request is finished, change the loading to false again.
            this.loading = false;
            // Clear the query.
            this.query = '';
        });
    }
}
});
