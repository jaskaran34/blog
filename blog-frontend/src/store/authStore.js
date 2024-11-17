import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    baseURL: 'http://127.0.0.1:8000/api',
    user: null,
    token: null,
    profile:null,
  }),
  actions: {
    setAuthData(user, token,profile) {
      this.user = user;
      this.token = token;
      this.profile = profile;

    },
    clearAuthData() {
      this.user = null;
      this.token = null;
      this.profile = profile;
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
    userName: (state) => state.user.name,
    profile_picture: (state) => state.profile,
  },
});