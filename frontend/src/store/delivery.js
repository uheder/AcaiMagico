import {defineStore} from "pinia";
import axiosClient from "../axios.js";

const useDeliveryStore = defineStore('delivery', {
    state: () => ({
        deliveries: []
    }),
    actions: {
        async fetchDeliveries() {
            try {
                const response = await axiosClient.get('/api/deliveries');
                this.deliveries = response.data
            } catch (error) {
                console.error('Erro ao carregar entregas',error);
                throw error;
            }
        },

        async update_delivery(delivery, status) {
            try {
                const response = await axiosClient.put(`/api/deliveries/${delivery.id}`, {
                    status: status
                });
                const deliveryData = response.data;
                this.deliveries = this.deliveries.map(d => d.id === delivery.id ? {...d, status: deliveryData.status} : d);
            } catch (error) {
                console.error('Erro ao atualizar status da entrega', error);
                throw error;
            }
        },
    }
});

export default useDeliveryStore;