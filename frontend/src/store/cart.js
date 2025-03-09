import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useCartStore = defineStore('cart', {
    state: () => ({
        cart: [],
        deliveryData: JSON.parse(localStorage.getItem('deliveryData')) || {},
    }),

    actions: {
        async fetchCart() {
            try {
                const response = await axiosClient.get('/api/cart');
                this.cart = response.data;
            } catch (error) {
                console.error('Erro ao buscar o carrinho:', error);
                throw error;
            }
        },

        async addToCart(item) {
            try {
                const response = await axiosClient.post('/api/cart', item);
                this.cart = this.fetchCart();
            } catch (error) {
                console.error('Erro ao adicionar ao carrinho:', error);
                throw error;
            }
        },

        async removeFromCart(index) {
            try {
                const response = await axiosClient.delete(`/api/cart/${index}`);
                this.cart = response.data;
            } catch (error) {
                console.error('Erro ao remover do carrinho:', error);
                throw error;
            }
        },

        async saveDeliveryData(data) {
            this.deliveryData = data;
            localStorage.setItem('deliveryData', JSON.stringify(data));
        },

        getDeliveryData() {
            const data = localStorage.getItem('deliveryData');
            if (data) {
                this.deliveryData =JSON.parse(data);
            } else {
                this.deliveryData = null;
            }
        }
    }
})


export default useCartStore;