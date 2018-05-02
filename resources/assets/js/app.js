
import Clients from './Clients.vue';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('client-list', ClientList);

Vue.prototype.$eventHub = new Vue();


const app = new Vue({
    el: '#app',
    components: {
       Clients
    }

});

//Single client
const singleClient = require('./singleClient');

console.log('started');

