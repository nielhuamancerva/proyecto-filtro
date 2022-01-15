
require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue';

import router from './routes';
import swal from 'sweetalert';
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'

Vue.config.productionTip = false
const app = new Vue({
    router,
    el: '#app'
});


