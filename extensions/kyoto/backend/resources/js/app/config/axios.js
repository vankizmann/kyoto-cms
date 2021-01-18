axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

// Add a request interceptor
axios.interceptors.request.use(
    (config) => {

        Nano.Obj.get(config, 'onLoad', () => {})();

        // Do something before request is sent
        return config;
    },
    (error) => {

        Nano.Obj.get(error.config, 'onDone', () => {})();

        // Do something with request error
        return Promise.reject(error);
    }
);

// Add a response interceptor
axios.interceptors.response.use(
    (response) => {

        Nano.Obj.get(response.config, 'onDone', () => {})();

        if ( Nano.Obj.has(response, 'data.message') ) {
            Notify(response.data.message, 'success');
        }

        // Do something with response data
        return response;
    },
    (error) => {

        Nano.Obj.get(error.config, 'onDone', () => {})();

        if ( Nano.Obj.has(error, 'response.data.message') ) {
            Notify(error.response.data.message, 'danger');
        }

        // Do something with response error
        return Promise.reject(error.response);
    }
);
