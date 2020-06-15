import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import Axios from 'axios';
window.axios = Axios;

import Nano from 'nano-js';
window.Nano = Nano;

require('./app/app');

if ( console && console.log ) {
    console.log('kyoto/backend ready.');
}

