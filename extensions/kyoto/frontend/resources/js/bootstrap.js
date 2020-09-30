import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

import Axios from 'axios';
window.axios = Axios;

require('./config/axios');

if ( console && console.log ) {
    console.log('kyoto/frontend ready.');
}

