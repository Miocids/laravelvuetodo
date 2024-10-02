import axios from 'axios';
import store from '../store';

const apiClient = axios.create({
    baseURL: 'https://laravelvuetodo-production.up.railway.app/api',
    withCredentials: true,
});

apiClient.interceptors.request.use((config) => {
    const token = store.state.token;
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
}, (error) => {
    return Promise.reject(error);
});

export default {
    register(user) {
        return apiClient.post('/register', user);
    },
    login(credentials) {
        return apiClient.post('/login', credentials);
    },
    logout() {
        return apiClient.post('/logout');
    },
    getUser() {
        return apiClient.get('/user');
    },
};
