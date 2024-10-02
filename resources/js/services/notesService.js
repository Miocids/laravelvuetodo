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
    getNotes() {
        return apiClient.get('/notes');
    },
    getNote(id) {
        return apiClient.get(`/notes/${id}`);
    },
    createNote(note) {
        return apiClient.post('/notes', note);
    },
    updateNote(id, note) {
        return apiClient.put(`/notes/${id}`, note);
    },
    deleteNote(id) {
        return apiClient.delete(`/notes/${id}`);
    },
};
