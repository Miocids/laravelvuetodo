import { createStore } from 'vuex';
import axios from 'axios';

const store = createStore({
  state: {
    token: localStorage.getItem('token') || null,
    user: null,
  },
  mutations: {
    setToken(state, token) {
      state.token = token;
    },
    setUser(state, user) {
      state.user = user;
    },
    clearAuth(state) {
      state.token = null;
      state.user = null;
    },
  },
  actions: {
    async login({ commit }, credentials) {
      const response = await axios.post('/api/login', credentials);
      const token = response.data.token;
      localStorage.setItem('token', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      commit('setToken', token);
    },
    async fetchUser({ commit, state }) {
      try {
        const response = await axios.get('/api/user', {
          headers: {
            'Authorization': `Bearer ${state.token}`,
            'Content-Type': 'application/json',
          }
        });
        commit('setUser', response.data);
      } catch (error) {
        console.error('Error fetching user:', error);
      }
    },
    logout({ commit }) {
      localStorage.removeItem('token');
      axios.defaults.headers.common['Authorization'] = null;
      commit('clearAuth');
    },
    async register({ commit }, user) {
      const response = await axios.post('/api/register', user);
      const token = response.data.token;
      localStorage.setItem('token', token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      commit('setToken', token);
  },
  },
  getters: {
    isAuthenticated(state) {
      return !!state.token;
    },
    user(state) {
      return state.user;
    },
  },
});

export default store;
