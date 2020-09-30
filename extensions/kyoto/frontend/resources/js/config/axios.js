import Axios from "axios";

Axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};

// Add a request interceptor
Axios.interceptors.request.use(
    (config) => {
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

// Add a response interceptor
Axios.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        return Promise.reject(error.response);
    }
);
