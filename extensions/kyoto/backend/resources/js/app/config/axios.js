axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

// Add a request interceptor
axios.interceptors.request.use(
    (config) => {

        pi.Obj.get(config, 'onLoad', () => {})();

        // Do something before request is sent
        return config;
    },
    (error) => {

        pi.Obj.get(error.config, 'onDone', () => {})();

        // Do something with request error
        return Promise.reject(error);
    }
);

// Add a response interceptor
axios.interceptors.response.use(
    (response) => {

        pi.Obj.get(response.config, 'onDone', () => {})();

        if ( pi.Obj.has(response, 'data.message') ) {
            Notify(response.data.message, 'success');
        }

        // Do something with response data
        return response;
    },
    (error) => {

        pi.Obj.get(error.config, 'onDone', () => {})();

        if ( pi.Obj.has(error, 'response.data.message') ) {
            Notify(error.response.data.message, 'danger');
        }

        // Do something with response error
        return Promise.reject(error.response);
    }
);
