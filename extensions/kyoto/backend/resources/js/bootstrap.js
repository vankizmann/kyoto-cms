import jQuery from 'jquery';
global.$ = global.jQuery = jQuery;

const Vue = require('vue/dist/vue.esm-bundler');
global.Vue = Vue;

const VueRouter = require('vue-router/dist/vue-router.esm-bundler');
global.VueRouter = VueRouter;

const Axios = require('axios');
global.axios = Axios;

const moment = require('moment/dist/moment');
global.moment = moment;

const DOMPurify = require('dompurify');
global.DOMPurify = DOMPurify;

import { Pico } from "@kizmann/pico-js";
global.pi = Pico;

import { Nano } from '@kizmann/nano-ui';
global.nano = Nano;

import { Kyoto } from './lib/kyoto';
global.kyoto = Kyoto;

require('./app/app');

if ( console && console.log ) {
    console.log('kyoto/backend ready.');
}

