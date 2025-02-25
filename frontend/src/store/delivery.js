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
                this.deliveries = Object.values(response.data).map(delivery => ({
                    pedido: delivery['id'],
                    nome_cliente: delivery['delivery']['nome_cliente'],
                    telefone_cliente: delivery['delivery']['telefone_cliente'],
                    rua: delivery['delivery']['rua'],
                    bairro: delivery['delivery']['bairro'],
                    numero: delivery['delivery']['numero'],
                    referencia: delivery['delivery']['referencia'],
                    forma_pagamento: delivery['delivery']['forma_pagamento'],
                    troco: delivery['delivery']['troco'] ? 'Sim' : 'Não',
                    troco_para: delivery['delivery']['troco'] ? delivery['delivery']['troco_para'] : 0,
                }));
            } catch (error) {
                console.error(error);
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
                console.error(error);
            }
        },
    }
});

export default useDeliveryStore;