import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8000';
axios.defaults.headers.post['Content-Type'] = 'application/json';

// ? This enables cookie-based authentication
axios.defaults.withCredentials = true;

// Optional helper for token auth (not needed for Sanctum sessions)
export function setAuthToken(token) {
  axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
}

export default axios;
