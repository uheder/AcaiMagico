import axios from "axios";
import router from "./router.js";

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL,
    // withCredentials: true,
    // withXSRFToken: true,
})

axios.interceptors.response.use((response) => {
    return response;
}, error => {
    // if user not authenticated
    if (error.response.status === 401) {
        router.push({name: 'Login'});}
    throw error;
})
export default axiosClient;