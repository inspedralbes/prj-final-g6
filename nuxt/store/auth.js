import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    authenticated: false,
    user: null,
    token: null,
  }),
  getters: {
    isAuthenticated() {
      return this.authenticated;
    },
    getUser() {
      return this.user;
    },
    getToken() {
      return this.token;
    },
  },
  actions: {
    async checkAuthentication() {
      try {
        const response = await this.$axios.post('/check-authentication');
        this.authenticated = response.data.authenticated;
        this.user = response.data.user;
      } catch (error) {
        console.error('Error checking authentication:', error);
      }
    },

    async register(userCredentials) {
      try {
        const response = await this.$axios.post('/register', userCredentials);
        this.user = response.data.user;
        this.token = response.data.token;
        this.authenticated = true;
      } catch (error) {
        console.error('Error registering:', error);
      }
    },

    async login(credentials) {
      try {
        const response = await this.$axios.post('/login', credentials);
        this.user = response.data.user;
        this.token = response.data.token;
        this.authenticated = true;
      } catch (error) {
        console.error('Error logging in:', error);
      }
    },

    async logout() {
      try {
        await this.$axios.post('/logout');
        this.user = null;
        this.token = null;
        this.authenticated = false;
      } catch (error) {
        console.error('Error logging out:', error);
      }
    },

    async fetchUserProfile() {
      try {
        const response = await this.$axios.get('/user');
        this.user = response.data;
      } catch (error) {
        console.error('Error fetching user profile:', error);
      }
    },
  },
});
