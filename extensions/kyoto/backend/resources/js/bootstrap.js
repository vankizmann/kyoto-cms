import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

const Vue = require('vue/dist/vue.esm-bundler');
window.Vue = Vue;

// import VueRouter from 'vue-router/dist/vue-router.global';
const VueRouter = require('vue-router/dist/vue-router.esm-bundler');
window.VueRouter = VueRouter;

const Axios = require('axios');
window.axios = Axios;

import Nano from 'nano-js';
window.Nano = Nano;

require('./app/app');

if ( console && console.log ) {
    console.log('kyoto/backend ready.');
}

