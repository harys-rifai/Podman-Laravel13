import axios from 'axios';
import * as bootstrap from 'bootstrap';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response?.status === 401) {
            window.location.reload();
        }
        return Promise.reject(error);
    }
);