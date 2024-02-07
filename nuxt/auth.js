// auth.js

export const state = () => ({
    user: null,
    isAuthenticated: false,
  });
  
  export const getters = {
    getUser: (state) => state.user,
    isAuthenticated: (state) => state.isAuthenticated,
  };
  
  export const mutations = {
    setUser(state, user) {
      state.user = user;
      state.isAuthenticated = !!user;
    },
    clearUser(state) {
      state.user = null;
      state.isAuthenticated = false;
    },
  };
  
  export const actions = {
    async login({ commit }, credentials) {
      try {
        const response = await this.$http.post('/api/login', credentials);
        commit('setUser', response.data.user);
      } catch (error) {
        console.error(error);
      }
    },
  
    async logout({ commit }) {
      try {
        await this.$http.post('/api/logout');
        commit('clearUser');
      } catch (error) {
        console.error(error);
      }
    },
  
    async checkAuthentication({ commit }) {
      try {
        const response = await this.$http.get('/api/check-authentication');
        const isAuthenticated = response.data.authenticated;
        commit('setUser', isAuthenticated ? response.data.user : null);
      } catch (error) {
        console.error(error);
      }
    },
  
    async register({ commit }, credentials) {
      try {
        const response = await this.$http.post('/api/register', credentials);
        commit('setUser', response.data.user);
      } catch (error) {
        console.error(error);
      }
    },
  
    async fetchUser({ commit }) {
      try {
        const response = await this.$http.get('/api/user');
        commit('setUser', response.data.user);
      } catch (error) {
        console.error(error);
      }
    },
  
    async updateUser({ commit }, user) {
      try {
        const response = await this.$http.put('/api/user', user);
        commit('setUser', response.data.user);
      } catch (error) {
        console.error(error);
      }
    },
  
    async deleteUser({ commit }) {
      try {
        await this.$http.delete('/api/user');
        commit('clearUser');
      } catch (error) {
        console.error(error);
      }
    },
  
    async fetchUserById({ commit }, id) {
      try {
        const response = await this.$http.get(`/api/user/${id}`);
        commit('setUser', response.data.user);
      } catch (error) {
        console.error(error);
      }
    },
  };
  