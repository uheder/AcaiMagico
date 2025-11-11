import {defineStore} from "pinia";
import axiosClient from "../axios.js";
import cart from "@/components/Pages/Delivery/Cart.vue";

const useCartStore = defineStore('cart', {
    state: () => ({
        cart: { items: [], total: 0},

        // TODO: Ajustar delivery para storar dados do delivery em sessão
        // deliveryData: JSON.parse(localStorage.getItem('deliveryData')) || {},
    }),

    actions: {
        async fetchCart() {
            try {
                const response = await axiosClient.get('/api/cart');
                this.cart = response.data;
                return response.data;
            } catch (error) {
                console.error('Erro ao buscar o carrinho:', error);
                throw error;
            }
        },

        async addToCart(item) {
            try {
                await axiosClient.post('/api/cart', item);
                await this.fetchCart();
            } catch (error) {
                console.error('Erro ao adicionar ao carrinho:', error);
                throw error;
            }
        },

        async removeFromCart(index) {
            try {
                await axiosClient.delete(`/api/cart/${index}`);
                await this.fetchCart();
            } catch (error) {
                console.error('Erro ao remover do carrinho:', error);
                throw error;
            }
        },

        // TODO

       /* async saveDeliveryData(data) {
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

        */
    }
})


export default useCartStore;